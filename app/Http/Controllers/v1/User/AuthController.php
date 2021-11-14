<?php

namespace App\Http\Controllers\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\{UpdateFireBaseTokenNonAuthRequest,
	ValidateAccessTokenRequest,
	VerifyCodeRequest,
	updateFireBaseTokenRequest,
	VersionRequest,
	VoiceRequest,
	VerifyCodeValidateRequest,
	RegisterRequest,
	LogoutRequest,
	RefreshTokenRequest};
use App\Http\Resources\ActionResource;
use App\Models\Common\Option;
use App\Models\User\Social;
use App\Models\User\Voice;
use App\Models\User\Firebase;
use App\Models\User\Passport\AccessToken;
use App\Models\User\Passport\RefreshToken;
use App\Models\User\Role;
use App\Models\User\SMS;
use App\Models\User\Code;
use App\Models\User\User;
use App\Traits\IssueTokenTrait;
use Carbon\Carbon;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\v1\Auth
 */
class AuthController extends Controller
{
	use IssueTokenTrait;

	/**
	 * @param VerifyCodeRequest $request
	 *
	 * @return ActionResource
	 */
	public function verifyCodeRequest(VerifyCodeRequest $request)
	{
		/** @var Code $code */
		$code = Code::wherePhone($request->phone)->first();

		if ($code) {

			/** check token expire */
			if ($code->updated_at->addMinutes(config('app.sms_expire')) > Carbon::now()) {

				return ActionResource(trans('messages.sms.two_minute', ['minute' => config('app.sms_expire')]), false);

			} else {
				$code->update([
					'code'   => $code->generateVerifyCode(),
					'status' => false,
				]);
			}

		} else {
			$code = Code::create([
				'phone'  => $request->phone,
				'code'   => Code::generateVerifyCode(),
				'type'   => Code::TYPE_NOT_SET,
				'status' => false,
			]);
		}

		/** @var User $user */
		$user = User::wherePhone($request->phone)->first();

		/** check user exist */
		if ($user) {
			/** update user_id and type */
			$code->update([
				'user_id' => $user->id,
				'type'    => Code::TYPE_LOGIN,
			]);

			/** Save SMS and Send verify code by SMSObserver */
			SMS::store(trans('messages.sms.confirmation', ['token' => $code->code]), $request->phone, $user->id);

			return ActionResource(trans('api.v1.user.sms.send'), true, [
				'sms_expire'   => (int)config('app.sms_expire'),
				'force_update' => false,
			]);

		} else {
			/** update type */
			$code->update([
				'type' => Code::TYPE_REGISTER,
			]);

			/** Save SMS and Send verify code by SMSObserver */
			SMS::store(trans('messages.sms.confirmation', ['token' => $code->code]), $request->phone, NULL);

			return ActionResource(trans('api.v1.user.sms.send'), true, [
				"sms_expire"   => (int)config('app.sms_expire'),
				"force_update" => false,
			]);
		}
	}

	/**
	 * @param VoiceRequest $request
	 *
	 * @return ActionResource
	 */
	public function voiceRequest(VoiceRequest $request)
	{
		/** @var Code $code */
		$code = Code::wherePhone($request->phone)
			->whereStatus(false)
			->first();

		/** check token value */
		if (is_null($code)) {
			return ActionResource(trans('messages.sms.not_send_code'), false);
		}

		/** check token expire */
		if ($code->updated_at->addMinutes(config('app.sms_expire')) > Carbon::now()) {
			return ActionResource(trans('messages.voice.two_minute', ['minute' => config('app.sms_expire')]), false);
		}

		/** @var Voice $voice */
		$voice = Voice::whereUserId($code->user_id)
			->wherePhone($request->phone)
			->first();

		/** check voice exist */
		if ($voice) {

			/** check voice expire */
			if ($voice->updated_at->addMinutes(config('app.voice_call_expire')) > Carbon::now()) {
				return ActionResource(trans('messages.voice.minute', ['minute' => config('app.voice_call_expire')]), false);

			} else {
				/** delete old voice */
				try {
					$voice->delete();
				} catch (\Exception $e) {
					return ActionResource(trans('messages.request.invalid'), false);
				}
			}

		}

		/** create new voice */
		Voice::create([
			'user_id' => $code->user_id,
			'phone'   => $request->phone,
			'message' => trans('messages.voice.' . $code->type, ['token' => substr($code->code, 0, 2) . ',' . substr($code->code, 2, 2)]),
		]);

		return ActionResource(trans('messages.voice.called'), true, [
			'voice_call_expire' => (int)config('app.voice_call_expire'),
		]);

	}

	/**
	 * @param VerifyCodeValidateRequest $request
	 *
	 * @return ActionResource
	 */
	public function verifyCodeValidate(VerifyCodeValidateRequest $request)
	{
		/** @var Code $code */
		$code = Code::wherePhone($request->phone)
			->whereCode($request->code)
			->first();

		/** Check the correct verify code */
		if (is_null($code)) {
			return ActionResource(trans('messages.sms.wrong_code'), false);

			/** Check verify code validation */
		} elseif ($code->status == true) {
			return ActionResource(trans('messages.sms.invalid_code'), false);
		}

		/** check user type: login */
		if ($code->type == Code::TYPE_LOGIN) {

			/** @var User $user [get by relation between Code model] */
			$user = $code->user;

			/** check user exist */
			if (is_null($user)) {
				return ActionResource(trans('messages.user.notFound'), false);
			}

			$type = $request->type;

			if ($type == User::ROLE_ADMIN) {
				// admin operation ...
				if (!$user->hasRole(User::ROLE_ADMIN)) {
					return ActionResource(trans('messages.exception.access_deny'), false);
				}

			} elseif ($type == User::ROLE_USER) {

				if (!$user->hasRole($type)) {

					/** @var Role $role */
					$role = Role::whereName($request->type)->firstOrFail();

					/** role attached to user */
					$user->attachRole($role);

				}

			}

			/** Generate Access Code and refresh token */
			$codeResult = $this->issueToken($user->phone, $code->code);

			if ($codeResult == NULL) {
				return ActionResource(trans('messages.request.invalid'), false);
			}

			/** Expect verify code */
			$code->update([
				'status' => true,
			]);

			/** generate access token with type value */
			$accessToken = setTypeToAccessToken($request->type, $codeResult['access_token']);

			return ActionResource(trans('api.v1.user.login.success'), true, [
				'type'          => Code::TYPE_LOGIN,
				'access_token'  => $accessToken,
				'refresh_token' => $codeResult['refresh_token'],
			]);

		}

		return ActionResource(trans('messages.sms.valid_code'), true, [
			'type' => Code::TYPE_REGISTER,
			//			'states' => State::all(),
			//			'cities' => City::all(),
		]);

	}

	/**
	 * @param RegisterRequest $request
	 * @return ActionResource|array
	 */
	public function register(RegisterRequest $request)
	{
		/** @var Code $code */
		$code = Code::wherePhone($request->phone)
			->whereCode($request->code)
			->whereStatus(false)
			->firstOrFail();

		/** check user exist */
		if (User::wherePhone($request->phone)->first()) {
			return ActionResource(trans('messages.user.exist'), false);
		}

		/** @var User $userRefer */
		$userRefer = NULL;

		/** handle refer in user data */
		if (isset($request->refer)) {

			/** @var User $userRefer */
			$userRefer = User::wherePhone($request->refer)->first();

			/** check exist refer user */
			if (is_null($userRefer)) {
				return ActionResource(trans('api.v1.user.register.invalidRefer'), false);
			}

		}

		/** @var User $user */
		$user = User::create([
			'first_name' => $request->first_name,
			'last_name'  => $request->last_name,
			'phone'      => $request->phone,
			'refer_id'   => isset($userRefer) ? $userRefer->id : NULL,
			'status'     => false,
		]);

		Social::create([
			'user_id' => $user->id,
			'type'    => Social::TYPE_MOBILE,
			'name'    => trans('models.social.mobile'),
			'value'   => $request->phone,
		]);

		/** @var Role $role */
		$role = Role::whereName($request->type)->firstOrFail();

		/** role attached to user */
		$user->attachRole($role);

		/** Expect verify code */
		$code->update([
			'user_id' => $user->id,
			'status'  => true,
		]);

		/** Generate Access Code and refresh token */
		$codeResult = $this->issueToken($user->phone, $code->code);

		/** generate access token with type value */
		$accessToken = setTypeToAccessToken($request->type, $codeResult['access_token']);

		return ActionResource(trans('api.v1.user.register.success'), true, [
			'access_token'  => $accessToken,
			'refresh_token' => $codeResult['refresh_token'],
		]);

	}

	/**
	 * validate access token by this method
	 *
	 * @param ValidateAccessTokenRequest $request
	 * @return ActionResource
	 */
	public function validateAccessToken(ValidateAccessTokenRequest $request)
	{
		return ActionResource(trans('messages.accessToken.valid'), true);
	}

	/**
	 * @param RefreshTokenRequest $request
	 * @return ActionResource
	 */
	public function refresh(RefreshTokenRequest $request)
	{
		/** Generate Access Code and refresh token */
		$codeResult = $this->refreshToken($request->refresh_token);

		if ($codeResult == NULL) {
			return ActionResource(trans('api.v1.user.refresh.invalid'), false);
		}

		/** generate access token with type value */
		$accessToken = setTypeToAccessToken($request->type, $codeResult['access_token']);

		return ActionResource(trans('messages.request.success'), true, [
			'version_app'   => Option::get('last_version'),
			'force_update'  => Option::get('force_update'),
			'access_token'  => $accessToken,
			'refresh_token' => $codeResult['refresh_token'],
		]);
	}

	/**
	 * @param VersionRequest $request
	 * @return ActionResource
	 */
	public function version(VersionRequest $request)
	{
		$role_app_force_update = NULL;
		$role_app_version = NULL;

		if ($request->type == User::ROLE_ADMIN) {

			$role_app_force_update = Option::get('admin_app_force_update');
			$role_app_version = Option::get('admin_app_version');

		}


		if ($request->type == User::ROLE_USER) {

			$role_app_force_update = Option::get('user_app_force_update');
			$role_app_version = Option::get('user_app_version');

		}

		return ActionResource(trans('messages.request.success'), true, [
			'version_app'  => $role_app_version,
			'force_update' => $role_app_force_update,
		]);
	}

	/**
	 * @param updateFireBaseTokenRequest $request
	 * @return ActionResource
	 */
	public function updateFireBaseTokenWithAuth(UpdateFireBaseTokenRequest $request)
	{
		/** @var User $user */
		$user = auth()->user();

		$type = getTypeFromAccessToken();

		if ($type['status']) {

			$code = Firebase::where([
				'user_id' => $user->id,
				'token'   => $request->firebase_token,
				'type'    => $type['type'],
			])->first();

			if (!$code) {
				Firebase::create([
					'user_id' => $user->id,
					'token'   => $request->firebase_token,
					'type'    => $type['type'],
				]);
			}

			return ActionResource(trans('api.v1.user.firebase_token'));

		} else {
			return ActionResource(trans('messages.exception.not_access'), false);

		}

	}

	/**
	 * @param UpdateFireBaseTokenNonAuthRequest $request
	 * @return ActionResource
	 */
	public function updateFireBaseTokenWithOutAuth(UpdateFireBaseTokenNonAuthRequest $request)
	{
		$code = Firebase::where([
			'token' => $request->firebase_token,
		])->first();

		if (!$code) {
			Firebase::create([
				'token' => $request->firebase_token,
			]);
		}

		return ActionResource(trans('api.v1.user.firebase_token'), true);
	}

	/**
	 * logout user by this method
	 *
	 * @param LogoutRequest $request
	 *
	 * @return ActionResource
	 * @throws \Exception
	 */
	public function logout(LogoutRequest $request)
	{
		/** delete all user access and refresh token */
		$this->destroyTokens(auth()->user());

		return ActionResource(trans('api.v1.user.logout.success'), true);
	}

	/**
	 * @param $user
	 * @throws \Exception
	 */
	private function destroyTokens($user)
	{
		$encodeAccess = getDecodedAccessToken();

		/** @var AccessToken[] $accessTokens */
		$accessTokens = AccessToken::where('user_id', '=', $user->id)
			->where('type', '=', $encodeAccess->type)
			->get();

		/** delete all user access and refresh token */
		foreach ($accessTokens as $code) {

			/** delete refresh token */
			RefreshToken::TokenID($code->id)->delete();

			/** delete access token */
			$code->delete();
		}
	}

}

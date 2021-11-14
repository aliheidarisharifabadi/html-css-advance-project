<?php

namespace App\Models\Notification;

use App\Models\Common\Option;
use App\Models\User\Firebase;
use App\Models\User\User;
use App\Traits\JCreatedAt;
use App\Traits\JUpdatedAt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;

/**
 * Class Notification
 *
 * @package App\Models\Notification
 *
 * @property integer            $id
 * @property integer            $user_id
 * @property string             $type
 * @property integer            $click_count
 * @property integer            $deliver_count
 * @property boolean            $status
 * @property Carbon             $created_at
 * @property Carbon             $updated_at
 *
 * @property User               $user
 * @property NotificationItem[] $notificationItems
 *
 */
class Notification extends Model
{
	use JCreatedAt, JUpdatedAt;

	protected $fillable = [
		'user_id',
		'type',
		'click_count',
		'deliver_count',
		'status',
	];

	protected $dates = [
		'created_at',
		'updated_at',
	];

	const TYPE_UPDATE = 'update';
	const TYPE_NEWS = 'news';
	const TYPE_ADS_SYSTEM = 'ads_system';
	const TYPE_ADS_USER = 'ads_user';

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function notificationItems()
	{
		return $this->hasMany(NotificationItem::class, 'notification_id');
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeActive(Builder $query)
	{
		return $query->where('notifications.status', true);
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeNotActive(Builder $query)
	{
		return $query->where('notifications.status', false);
	}

	/**
	 * @param array  $dataInput
	 * @param string $role
	 * @return array
	 */
	public static function fireToRole(array $dataInput, string $role)
	{
		if ($role == User::ROLE_ADMIN) {

			/**
			 * call this method and set config fcm data
			 * by default passing null parameters for visitors
			 */
			setConfigFcm();

		} elseif ($role == User::ROLE_USER) {

			/**
			 * call this method and set config fcm data
			 * passing parameters for customers
			 */
			setConfigFcm(
				Option::get('fcm_protocol_customer'),
				Option::get('fcm_server_key_customer'),
				Option::get('fcm_sender_id_customer')
			);

		} else {

			return [
				'status'  => false,
				'message' => 'گروه کاربری انتخاب شده اشتباه است',
			];

		}

		/** @var Firebase $tokens */
		$tokens = Firebase::select(['token'])
			->where('type', $role)
			->get()
			->pluck('token');

		if ($tokens->isEmpty()) {
			return [
				'status'  => false,
				'message' => 'فایربیس توکن یافت نشد',
			];
		}

		/**
		 * call this method and set config fcm data
		 * by default passing null parameters for visitors
		 */
		setConfigFcm();

		/** @var PayloadNotificationBuilder $notificationBuilder */
		$notificationBuilder = new PayloadNotificationBuilder();

		$notificationBuilder
			->setTitle($dataInput['title'])
			->setBody($dataInput['body'])
			->setSound('default');

		$notification = $notificationBuilder->build();

		/** @var PayloadDataBuilder $dataBuilder */
		$dataBuilder = new PayloadDataBuilder();
		$dataBuilder->addData($dataInput);

		$data = $dataBuilder->build();

		$downstreamResponse = FCM::sendTo($tokens->toArray(), NULL, $notification, $data);

		/** delete all invalid firebase token */
		foreach ($downstreamResponse->tokensToDelete() as $token) {
			DB::table('firebase')->where('token', '=', $token)->delete();
		}

		return [
			'status'        => true,
			'numberSuccess' => $downstreamResponse->numberSuccess(),
			'numberFailure' => $downstreamResponse->numberFailure(),
		];

//		return [
//			'numberSuccess'      => $downstreamResponse->numberSuccess(),
//			'numberFailure'      => $downstreamResponse->numberFailure(),
//			'numberModification' => $downstreamResponse->numberModification(),
//			'tokensToDelete'     => $downstreamResponse->tokensToDelete(),
//			'tokensToModify'     => $downstreamResponse->tokensToModify(),
//			'tokensToRetry'      => $downstreamResponse->tokensToRetry(),
//			'tokensWithError'    => $downstreamResponse->tokensWithError(),
//		];

	}

	/**
	 * @param int    $user_id
	 * @param array  $dataInput
	 * @param string $role
	 * @return array
	 */
	public static function fireToUserDevices(int $user_id, string $role, array $dataInput)
	{
		/** @var User $user */
		$user = User::findOrFail($user_id);

		if (empty($user)) {
			return [
				'status'  => false,
				'message' => 'کاربر یافت نشد',
			];
		}

		if (!$user->hasRole($role)) {
			return [
				'status'  => false,
				'message' => 'کاربر نقش مورد نظر را ندارد.',
			];
		}

		if ($role == User::ROLE_ADMIN) {

			/**
			 * call this method and set config fcm data
			 * by default passing null parameters for visitors
			 */
			setConfigFcm();

		} elseif ($role == User::ROLE_USER) {

			/**
			 * call this method and set config fcm data
			 * passing parameters for customers
			 */
			setConfigFcm(
				Option::get('fcm_protocol_customer'),
				Option::get('fcm_server_key_customer'),
				Option::get('fcm_sender_id_customer')
			);

		} else {

			return [
				'status'  => false,
				'message' => 'گروه کاربری انتخاب شده اشتباه است',
			];

		}

		/** @var Firebase $tokens */
		$tokens = Firebase::select(['token'])
			->where('user_id', $user->id)
			->where('type', $role)
			->get()
			->pluck('token');

		if ($tokens->isEmpty()) {
			return [
				'status'  => false,
				'message' => 'فایربیس توکن یافت نشد',
			];
		}

		/** @var PayloadNotificationBuilder $notificationBuilder */
		$notificationBuilder = new PayloadNotificationBuilder();

		$notificationBuilder
			->setTitle($dataInput['title'])
			->setBody($dataInput['body'])
			->setSound('default');

		$notification = $notificationBuilder->build();

		/** @var PayloadDataBuilder $dataBuilder */
		$dataBuilder = new PayloadDataBuilder();
		$dataBuilder->addData($dataInput);

		$data = $dataBuilder->build();

		$downstreamResponse = FCM::sendTo($tokens->toArray(), NULL, $notification, $data);

		/** delete all invalid firebase token */
		foreach ($downstreamResponse->tokensToDelete() as $token) {
			DB::table('firebase')->where('token', '=', $token)->delete();
		}

		return [
			'status'        => true,
			'message'       => '',
			'numberSuccess' => $downstreamResponse->numberSuccess(),
			'numberFailure' => $downstreamResponse->numberFailure(),
		];

//		return [
//			'numberSuccess'      => $downstreamResponse->numberSuccess(),
//			'numberFailure'      => $downstreamResponse->numberFailure(),
//			'numberModification' => $downstreamResponse->numberModification(),
//			'tokensToDelete'     => $downstreamResponse->tokensToDelete(),
//			'tokensToModify'     => $downstreamResponse->tokensToModify(),
//			'tokensToRetry'      => $downstreamResponse->tokensToRetry(),
//			'tokensWithError'    => $downstreamResponse->tokensWithError(),
//		];

	}
}

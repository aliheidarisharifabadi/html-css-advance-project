<?php

namespace App\Http\Controllers\v1\User;

use App\Http\Requests\v1\User\Social\SocialEditRequest;
use App\Http\Requests\v1\User\Social\SocialIndexRequest;
use App\Http\Requests\v1\User\Social\SocialShowRequest;
use App\Http\Requests\v1\User\Social\SocialStatusRequest;
use App\Http\Requests\v1\User\Social\SocialStoreRequest;
use App\Http\Requests\v1\User\Social\SocialUpdateRequest;
use App\Http\Resources\v1\User\Social\SocialEditResource;
use App\Http\Resources\v1\User\Social\SocialIndexResource;
use App\Http\Resources\v1\User\Social\SocialShowResource;
use App\Models\Common\Photo;
use App\Models\User\Social;
use App\Models\User\User;
use App\Http\Controllers\Controller;

class SocialController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param SocialIndexRequest $request
	 * @return \App\Http\Resources\ActionResource|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(SocialIndexRequest $request)
	{
		/** @var Social $query */
		$query = Social::query();

		/** @var User $user */
		$user = auth()->user();

		/** @var Social[] $socials */
		$socials = [];

		$role = $user->canUser('social.index');

		if ($role == User::ROLE_ADMIN) {

			$socials = $query->all();

		} elseif ($role == User::ROLE_USER) {

			$socials = $query->Mine()->get();

		} else {

			return ActionResource(trans('messages.exception.not_access'), false);

		}

		return SocialIndexResource::collection($socials)->additional([
			'success' => true,
			'message' => '',
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param SocialStoreRequest $request
	 * @return
	 */
	public function store(SocialStoreRequest $request)
	{
		/** @var User $user */
		$user = auth()->user();

		if (isset($request->user_id)) {

			if (!$user->hasRole(User::ROLE_ADMIN)) {

				return ActionResource(trans('messages.exception.not_access'), false);

			}
			/** @var User $userSocial */
			$userSocial = User::where('id', $request->user_id)->first();

		} else {
			$userSocial = $user;
		}

		if ($request->hasFile('photo')) {
			/** @var Photo $photo */
			$photo = Photo::create([
				'user_id'   => $userSocial->id,
				'disk'      => Photo::DISK_LOCAL,
				'thumbnail' => photoUploader($request->file('photo'), Photo::TYPE_THUMBNAIL, mt_rand(10, 99)),
				'path'      => photoUploader($request->file('photo'), Photo::TYPE_SOCIAL, mt_rand(10, 99)),
				'ext'       => $request->file('photo')->getClientOriginalExtension(),
				'type'      => Photo::TYPE_SOCIAL,
			]);
		}

		Social::create([
			'user_id'  => $userSocial->id,
			'photo_id' => isset($photo) ? $photo->id : NULL,
			'type'     => $request->type,
			'name'     => trans('models.social.' . $request->type),
			'value'    => $request->value,
		]);

		return ActionResource(trans('messages.social.stored'), true);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param SocialShowRequest        $request
	 * @param  \App\Models\User\Social $social
	 * @return \App\Http\Resources\ActionResource|SocialShowResource
	 * @throws \Exception
	 */
	public function show(SocialShowRequest $request, Social $social)
	{
		/** @var User $user */
		$user = auth()->user();

		$role = $user->canUser('social.show');

		if ($role == User::ROLE_USER) {

			if ($social->user_id != $user->id) {

				return ActionResource(trans('messages.social.notValid'), false);

			}

		}

		return new SocialShowResource($social);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param SocialEditRequest        $request
	 * @param  \App\Models\User\Social $social
	 * @return SocialEditResource|\Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function edit(SocialEditRequest $request, Social $social)
	{
		/** @var User $user */
		$user = auth()->user();

		$role = $user->canUser('social.edit');

		if ($role == User::ROLE_USER) {

			if ($social->user_id != $user->id) {

				return ActionResource(trans('messages.social.notValid'), false);

			}

		}

		return new SocialEditResource($social);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param SocialUpdateRequest      $request
	 * @param  \App\Models\User\Social $social
	 * @return \App\Http\Resources\ActionResource
	 */
	public function update(SocialUpdateRequest $request, Social $social)
	{
		/** @var User $user */
		$user = auth()->user();

		if (isset($request->user_id)) {

			if (!$user->hasRole(User::ROLE_ADMIN)) {

				return ActionResource(trans('messages.exception.not_access'), false);

			}
			/** @var User $userSocial */
			$userSocial = User::where('id', $request->user_id)->first();

		} else {
			$userSocial = $user;
		}

		$data = $request->only([
			'type',
			'value'
		]);

		if ($request->hasFile('photo')) {

			/** @var Photo $photo */
			$photo = Photo::create([
				'user_id'   => $userSocial->id,
				'disk'      => Photo::DISK_LOCAL,
				'thumbnail' => photoUploader($request->file('photo'), Photo::TYPE_THUMBNAIL, mt_rand(10, 99)),
				'path'      => photoUploader($request->file('photo'), Photo::TYPE_SOCIAL, mt_rand(10, 99)),
				'ext'       => $request->file('photo')->getClientOriginalExtension(),
				'type'      => Photo::TYPE_SOCIAL,
			]);

			if (isset($social->photo_id)) {

				if (file_exists(storage_path($social->photo->path))) {

					unlink(storage_path($social->photo->path));

				}

				if (file_exists(storage_path($social->photo->thumbnail))) {

					unlink(storage_path($social->photo->thumbnail));

				}

			}

			$data = array_merge($data, ['photo_id' => $photo->id]);

		}

		$social->update($data);

		return ActionResource(trans('messages.social.updated'), true);
	}

	/**
	 * @param SocialStatusRequest $request
	 * @param Social              $social
	 * @return \App\Http\Resources\ActionResource
	 */
	public function status(SocialStatusRequest $request, Social $social)
	{
		/** @var User $user */
		$user = auth()->user();

		if ($social->user_id != $user->id) {

			return ActionResource(trans('messages.social.notExist'), false);

		}

		if ($social->status == $request->status) {

			return ActionResource(trans('messages.social.invalidStatus'), false);

		}

		$social->status = $request->status;
		$social->save();

		return ActionResource(trans('messages.visitCard.updatedStatus'), true);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User\Social $social
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Social $social)
	{
		//
	}
}

<?php

namespace App\Http\Controllers\v1\Common;

use App\Http\Requests\v1\Common\Photo\{
	PhotoStoreRequest,
	AvatarStoreRequest,
	PhotoUpdateRequest
};
use App\Http\Resources\v1\Common\Photo\{
	PhotoStoreResource,
	AvatarStoreResource,
	PhotoUpdateResource
};
use App\Models\Common\Photo;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  PhotoStoreRequest $request
	 * @return \App\Http\Resources\v1\Common\Photo\PhotoStoreResource
	 * @throws \Exception
	 */
	public function store(PhotoStoreRequest $request)
	{
		/** @var Photo $photo */
		$photo = Photo::create([
			'user_id'   => auth()->user()->id,
			'disk'      => 'local',
			'thumbnail' => photoUploader($request->file('photo'), Photo::TYPE_THUMBNAIL, mt_rand(10, 99)),
			'path'      => photoUploader($request->file('photo'), Photo::TYPE_MEDIA, mt_rand(10, 99)),
			'ext'       => $request->file('photo')->getClientOriginalExtension(),
		]);

        return new PhotoStoreResource($photo, true, trans('messages.photo.success'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  AvatarStoreRequest $request
	 * @return AvatarStoreResource
	 * @throws \Exception
	 */
	public function storeAvatar(AvatarStoreRequest $request)
	{
		/** get all avatars */
		$photos = auth()->user()->photos;

		/** check exist avatar, if exist replace and update this, else store new avatar */
		if ($photos->isNotEmpty()) {
			/** @var Photo $photo */
			$photo = $photos[0];

			$photo->update([
				'disk'      => 'local', //@todo [change disk storage]
				'thumbnail' => photoUploader($request->file('photo'), 'thumbnail', mt_rand(10, 99), $photo->thumbnail),
				'path'      => photoUploader($request->file('photo'), 'avatar', mt_rand(10, 99), $photo->path),
				'ext'       => $request->file('photo')->getClientOriginalExtension(),
			]);

            return new AvatarStoreResource($photo, true, trans('messages.photo.avatarReplaced'));

		} /** if not exist avatar, create new avatar */
		else {
			$photo = Photo::create([
				'user_id'   => auth()->user()->id,
				'disk'      => 'local', //@todo [change disk storage]
				'thumbnail' => photoUploader($request->file('photo'), 'thumbnail', mt_rand(10, 99)),
				'path'      => photoUploader($request->file('photo'), 'avatar', mt_rand(10, 99)),
				'ext'       => $request->file('photo')->getClientOriginalExtension(),
			]);

            return new AvatarStoreResource($photo, true, trans('messages.photo.avatar'));

		}

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param PhotoUpdateRequest $request
	 * @param Photo              $photo
	 * @return PhotoUpdateResource
	 * @throws \Exception
	 */
	public function update(PhotoUpdateRequest $request, Photo $photo)
	{
		$photo->update([
			'disk'      => 'local', //@todo [change disk storage]
			'thumbnail' => photoUploader($request->file('photo'), 'thumbnail', mt_rand(10, 99), $photo->thumbnail),
			'path'      => photoUploader($request->file('photo'), 'photo', mt_rand(10, 99), $photo->path),
			'ext'       => $request->file('photo')->getClientOriginalExtension(),
		]);

        return new PhotoUpdateResource($photo, true, trans('messages.photo.replaced'));
	}

}

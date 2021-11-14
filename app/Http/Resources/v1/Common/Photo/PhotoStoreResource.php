<?php

namespace App\Http\Resources\v1\Common\Photo;

use App\Http\Resources\SetResource;
use App\Models\Common\Photo;

/**
 * Class PhotoStoreResource
 *
 * @package App\Http\Resources\v1\Common\Photo
 * @mixin Photo
 */
class PhotoStoreResource extends SetResource
{
	protected $model = Photo::class;

	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			"id"            => $this->id,
			"url"           => $this->url,
			"thumbnail_url" => $this->thumbnail_url,
		];
	}

}

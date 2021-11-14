<?php

namespace App\Http\Resources\v1\User\Social;

use App\Http\Resources\SetResource;
use App\Models\User\Social;

/**
 * Class SocialIndexResource
 *
 * @package App\Http\Resources\v1\User\Social
 *
 * @mixin Social
 *
 */
class SocialIndexResource extends SetResource
{
	protected $model = Social::class;

	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{

		return [
			'id'                  => $this->id,
			'name'                => $this->name,
			'value'               => $this->value,
			'status'              => $this->status,
			'photo_thumbnail_url' => $this->photo_thumbnail_url,
		];
	}
}

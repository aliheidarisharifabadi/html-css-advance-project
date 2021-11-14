<?php

namespace App\Http\Resources\v1\Common\Category;

use App\Http\Resources\SetResource;
use App\Models\Common\Category;
use App\Models\User\User;


/**
 * Class CategoryChildrenResource
 *
 * @property Category children
 * @property integer  id
 * @property string   name
 * @property string   photo_thumbnail_url
 * @package App\Http\Resources\v1\Common\Category
 */
class CategoryChildrenResource extends SetResource
{
	protected $model = Category::class;

	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{

		/** @var User $user */
		$user = auth()->user();


		return [
			'id'            => $this->id,
			'name'          => $this->name,
			'photo_url'     => $this->photo_thumbnail_url,

		];
	}

}

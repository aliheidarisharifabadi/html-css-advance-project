<?php

namespace App\Http\Resources\v1\Common\Category;

use App\Http\Resources\SetResource;
use App\Models\Common\Category;

/**
 * Class CategoryParentResource
 *
 * @property string  photo_thumbnail_url
 * @property string  description
 * @property string  name
 * @property integer id
 * @package App\Http\Resources\v1\Common\Category
 */
class CategoryParentResource extends SetResource
{
	protected $model = Category::class;

	/**
	 * Transform the resource into an array.
	 * Get children of category by using children() relation
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{

		return [
			'id'                  => $this->id,
			'name'                => $this->name,
			'description'         => $this->description,
			'photo_thumbnail_url' => $this->photo_thumbnail_url,

		];
	}

}

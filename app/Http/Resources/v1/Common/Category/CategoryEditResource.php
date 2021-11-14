<?php

namespace App\Http\Resources\v1\Common\Category;

use App\Http\Resources\SetResource;
use App\Models\Common\Category;

/**
 * Class CategoryEditResource
 *
 * @mixin Category
 * @package App\Http\Resources\v1\Common\Category
 *
 */
class CategoryEditResource extends SetResource
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
			'slug'                => $this->slug,
			'parent_id'           => $this->parent_id,
			'photo_id'            => $this->photo_id,
			'photo_url'           => $this->photo_url,
			'photo_thumbnail_url' => $this->photo_thumbnail_url,
			'selected'            => $this->selected,
		];
	}

}

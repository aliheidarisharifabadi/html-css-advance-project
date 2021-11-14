<?php

namespace App\Http\Resources\v1\Common\Category;

use App\Http\Resources\SetResource;
use App\Models\Common\Category;

/**
 * Class CategoryIndexResource
 *
 * @mixin Category
 * @property mixed children
 * @package App\Http\Resources\v1\Common\Category
 */
class CategoryIndexResource extends SetResource
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
			'id'            => $this->id,
			'name'          => $this->name,
			'description'   => $this->description,
			'photo_url'     => $this->photo_url,
			'childes_count' => $this->children->count(),
			'children'      => Category::treeData($this->id),
		];
	}

}

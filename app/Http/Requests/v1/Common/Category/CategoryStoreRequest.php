<?php

namespace App\Http\Requests\v1\Common\Category;

use App\Http\Requests\SetRequest;
use App\Models\Common\Category;

/**
 * Class CategoryStoreRequest
 *
 * Check Rules and Authorization for Creating the Category
 *
 * @package App\Http\Requests\v1\Common\Category
 *
 * @property string  $name
 * @property string  $description
 * @property string  $slug
 * @property integer $selected
 * @property integer $parent_id
 * @property integer $photo_id
 */
class CategoryStoreRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with category.store permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('category.store', Category::class);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array of rules
	 */
	public function rules()
	{
		return [
			'name'        => 'required|string|min:3|max:30|unique:categories',
			'description' => 'required|string|min:3|max:191',
			'slug'        => 'required|string|min:3|max:30|unique:categories',
			'selected'    => 'required|integer|in:0,1',
			'parent_id'   => 'nullable|integer|exists:categories,id',
			'photo_id'    => 'required|integer|min:1',
		];
	}

}

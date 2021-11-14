<?php

namespace App\Http\Requests\v1\Common\Category;

use App\Http\Requests\SetRequest;


/**
 * Class CategoryUpdateRequest
 *
 * Check Rules and Authorization for updating the Category
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
class CategoryUpdateRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with category.update permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$category = request()->route('category');

		return auth()->user()->can('category.update', $category);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'        => 'sometimes|string|min:3|max:30',
			'description' => 'sometimes|min:3|max:191',
			'slug'        => 'sometimes|min:3|max:30',
			'selected'    => 'sometimes|integer|in:0,1',
			'parent_id'   => 'sometimes|integer|exists:categories,id|nullable',
			'photo_id'    => 'sometimes|integer|min:1|exists:photos,id',
		];
	}

}

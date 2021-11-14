<?php

namespace App\Http\Requests\v1\Common\Category;

use App\Http\Requests\SetRequest;

/**
 * Class CategoryEditRequest
 *
 * Check Rules and Authorization for editing the Category
 *
 * @package App\Http\Requests\v1\Common\Category
 */
class CategoryEditRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with category.edit permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$category = request()->route('category');

		return auth()->user()->can('category.edit', $category);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			//
		];
	}

}

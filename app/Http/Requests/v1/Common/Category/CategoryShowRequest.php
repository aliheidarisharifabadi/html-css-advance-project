<?php

namespace App\Http\Requests\v1\Common\Category;

use App\Http\Requests\SetRequest;

/**
 * Class CategoryShowRequest
 *
 * Check Rules and Authorization for showing the Category
 *
 * @package App\Http\Requests\v1\Common\Category
 */
class CategoryShowRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with category.show permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$category = request()->route('category');

		return auth()->user()->can('category.show', $category);
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

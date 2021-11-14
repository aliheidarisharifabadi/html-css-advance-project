<?php

namespace App\Http\Requests\v1\Common\Category;

use App\Http\Requests\SetRequest;
use App\Models\Common\Category;

/**
 * Class CategoryParentRequest
 *
 * Check Rules and Authorization for showing the category parent list
 *
 * @package App\Http\Requests\v1\Common\Category
 */
class CategoryParentRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with category.parent permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;

		return auth()->user()->can('category.parent', Category::class);
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

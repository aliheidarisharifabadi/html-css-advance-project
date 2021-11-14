<?php

namespace App\Http\Requests\v1\Common\Category;

use App\Http\Requests\SetRequest;

/**
 * Class CategoryChildrenRequest
 *
 * Check Rules and Authorization for showing the category tree
 *
 * @package App\Http\Requests\v1\Common\Category
 */
class CategoryChildrenRequest extends SetRequest
{
    /**
     * Determine if the user is authorized with category.children permission to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	return true;

        $category = request()->route('category');

        return auth()->user()->can('category.children', $category);
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

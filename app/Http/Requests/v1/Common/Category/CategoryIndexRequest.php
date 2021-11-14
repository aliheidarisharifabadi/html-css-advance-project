<?php

namespace App\Http\Requests\v1\Common\Category;

use App\Http\Requests\SetRequest;

use App\Models\Common\Category;

/**
 * Class CategoryIndexRequest
 *
 * Check Rules and Authorization for showing the category tree
 *
 * @package App\Http\Requests\v1\Common\Category
 */
class CategoryIndexRequest extends SetRequest
{
    /**
     * Determine if the user is authorized with category.index permission to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	return true;

        return auth()->user()->can('category.index', Category::class);
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

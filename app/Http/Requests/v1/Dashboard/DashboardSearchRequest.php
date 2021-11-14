<?php

namespace App\Http\Requests\v1\Dashboard;

use App\Http\Requests\SetRequest;

/**
 * Class DashboardSearchRequest
 *
 * @package App\Http\Requests\v1\Dashboard
 *
 * @property string  $search
 * @property integer $category_id
 * @property integer $state_id
 * @property integer $city_id
 */
class DashboardSearchRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'search'      => 'sometimes|string|min:3|max:70',
			'category_id' => 'sometimes|integer|exists:categories,id',
			'state_id'    => 'sometimes|integer|exists:states,id',
			'city_id'     => 'sometimes|integer|exists:cities,id',
		];
	}
}


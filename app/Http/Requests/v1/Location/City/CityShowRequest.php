<?php

namespace App\Http\Requests\v1\Location\City;

use App\Http\Requests\SetRequest;

/**
 * Class StateShowRequest
 *
 * @package App\Http\Requests\v1\Common\CityStoreResource
 */
class CityShowRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$city = $this->route('city');

		return auth()->user()->can('city.show', $city);
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

<?php

namespace App\Http\Requests\v1\Location\City;

use App\Http\Requests\SetRequest;

/**
 * Class CityUpdateRequest
 *
 * @package App\Http\Requests\v1\Location\City
 *
 * @property integer $state_id
 * @property string  $name
 */
class CityUpdateRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$city = $this->route('city');

		return auth()->user()->can('city.update', $city);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'state_id' => 'sometimes|exists:states,id',
			'name'     => 'sometimes|string',
		];
	}

}

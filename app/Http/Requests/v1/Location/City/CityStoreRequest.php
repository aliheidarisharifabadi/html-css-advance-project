<?php

namespace App\Http\Requests\v1\Location\City;

use App\Http\Requests\SetRequest;
use App\Models\Location\City;

/**
 * Class CityStoreRequest
 *
 * @package App\Http\Requests\v1\Location\City
 *
 * @property integer $state_id
 * @property string  $name
 */
class CityStoreRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('city.store', City::class);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'state_id' => 'required|exists:states,id',
			'name'     => 'required|string',
		];
	}
}

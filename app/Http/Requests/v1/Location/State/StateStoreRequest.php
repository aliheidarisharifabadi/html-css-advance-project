<?php

namespace App\Http\Requests\v1\Location\State;

use App\Http\Requests\SetRequest;
use App\Models\Location\State;

/**
 * Class StateStoreRequest
 *
 * @package App\Http\Requests\v1\Location\State
 *
 * @property string $name
 */
class StateStoreRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('state.store', State::class);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|string',
		];
	}
}

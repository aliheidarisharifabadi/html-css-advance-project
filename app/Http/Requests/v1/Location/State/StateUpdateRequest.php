<?php

namespace App\Http\Requests\v1\Location\State;

use App\Http\Requests\SetRequest;

/**
 * Class StateUpdateRequest
 *
 * @package App\Http\Requests\v1\Location\State
 *
 * @property string $name
 */
class StateUpdateRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$state = $this->route('state');

		return auth()->user()->can('state.update', $state);
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

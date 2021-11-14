<?php

namespace App\Http\Requests\v1\Location\State;

use App\Http\Requests\SetRequest;

/**
 * Class StateShowRequest
 *
 * @package App\Http\Requests\v1\Location\State
 */
class StateShowRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$state = $this->route('state');

		return auth()->user()->can('state.show', $state);
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

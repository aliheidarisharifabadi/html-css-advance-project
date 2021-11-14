<?php

namespace App\Http\Requests\v1\Location\State;

use App\Http\Requests\SetRequest;
use App\Models\Location\State;

/**
 * Class StateIndexRequest
 *
 * @package App\Http\Requests\v1\Location\State
 */
class StateIndexRequest extends SetRequest
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
			//
		];
	}

}

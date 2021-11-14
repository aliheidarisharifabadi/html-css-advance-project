<?php

namespace App\Http\Requests\v1\Auth;

use App\Http\Requests\SetRequest;

/**
 * Class LogoutRequest
 *
 * @package App\Http\Requests\v1\Auth
 *
 */
class LogoutRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		/** check user logged */
		if (auth()->user())
			return true;

		return false;
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

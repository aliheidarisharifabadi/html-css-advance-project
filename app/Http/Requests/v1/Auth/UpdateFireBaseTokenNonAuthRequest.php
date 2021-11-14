<?php

namespace App\Http\Requests\v1\Auth;

use App\Http\Requests\SetRequest;

/**
 * Class UpdateFireBaseTokenNonAuthRequest
 *
 * @package App\Http\Requests\v1\Auth
 *
 * @property integer $firebase_token
 *
 */
class UpdateFireBaseTokenNonAuthRequest extends SetRequest
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
			'firebase_token' => 'required|string|min:1',
		];
	}
}

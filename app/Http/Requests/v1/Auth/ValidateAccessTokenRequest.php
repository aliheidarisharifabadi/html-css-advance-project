<?php

namespace App\Http\Requests\v1\Auth;

use App\Models\User\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ValidateAccessTokenRequest
 *
 * @package App\Http\Requests\v1\Auth
 *
 */
class ValidateAccessTokenRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('auth.validateAccessToken', User::class);
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

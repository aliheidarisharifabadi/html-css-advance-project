<?php

namespace App\Http\Requests\v1\Auth;

use App\Models\User\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RefreshTokenRequest
 *
 * @package App\Http\Requests\v1\Auth
 *
 * @property string $refresh_token
 *
 */
class RefreshTokenRequest extends FormRequest
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
			'refresh_token' => 'required|string',
			'type'          => 'required|in:' . implode(User::ROLES, ',') . ',' . User::ROLE_ADMIN,
		];
	}
}

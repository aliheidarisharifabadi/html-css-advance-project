<?php

namespace App\Http\Requests\v1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User\User;

/**
 * Class VersionRequest
 *
 * @property string type
 * @package App\Http\Requests\v1\Auth
 *
 */
class VersionRequest extends FormRequest
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
			'type' => 'required|in:' . implode(User::ROLES, ',')
		];
	}
}

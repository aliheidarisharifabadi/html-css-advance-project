<?php

namespace App\Http\Requests\v1\Auth;

use App\Models\User\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegisterRequest
 *
 * @package App\Http\Requests\v1\Auth
 *
 * @property string  $phone
 * @property string  $code
 * @property string  $first_name
 * @property string  $last_name
 * @property string  $refer
 * @property string  $type
 * @property integer $state_id
 * @property integer $city_id
 *
 */
class RegisterRequest extends FormRequest
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
			'phone'      => 'required|phone',
			'code'       => 'required|size:4',
			'first_name' => 'required|string|min:2',
			'last_name'  => 'required|string|min:2',
			'refer'      => 'sometimes|phone|exists:users,phone',
			'type'       => 'required|in:' . implode(User::ROLES, ','),
			//			'state_id'    => 'required|numeric|exists:states,id',
			//			'city_id'     => 'required|numeric|exists:cities,id',
		];
	}

	public function messages()
	{
		return [
			'refer.phone'       => 'شماره معرف معتبر نمی باشد',
			'state_id.required' => 'انتخاب استان الزامی است',
			'city_id.required'  => 'انتخاب شهر الزامی است',
		];
	}
}

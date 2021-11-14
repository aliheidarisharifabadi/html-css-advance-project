<?php

namespace App\Http\Requests\v1\Dashboard;

use App\Http\Requests\SetRequest;

/**
 * Class DashboardShowRequest
 *
 * @package App\Http\Requests\v1\Dashboard
 *
 */
class DashboardShowRequest extends SetRequest
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


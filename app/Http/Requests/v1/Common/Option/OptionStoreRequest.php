<?php

namespace App\Http\Requests\v1\Common\Option;

use App\Http\Requests\SetRequest;
use App\Models\Common\Option;

/**
 * Class OptionStoreRequest
 *
 * @package App\Http\Requests\v1\Common\Option
 *
 * @property string $name
 * @property string $value
 */
class OptionStoreRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('store', Option::class);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'  => 'required|string|min:1|unique:options',
			'value' => 'required|string|min:1',
		];
	}
}

<?php

namespace App\Http\Requests\v1\Common\Option;

use App\Http\Requests\SetRequest;
use App\Models\Common\Option;

/**
 * Class OptionShowRequest
 *
 * @package App\Http\Requests\v1\Common\Option
 */
class OptionShowRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		/** @var Option $option */
		$option = request()->route('option');

		return auth()->user()->can('show', $option);
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

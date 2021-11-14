<?php

namespace App\Http\Requests\v1\Common\Option;

use App\Http\Requests\SetRequest;
use App\Models\Common\Option;

/**
 * Class OptionEditRequest
 *
 * @package App\Http\Requests\v1\Common\Option
 */
class OptionEditRequest extends SetRequest
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

		return auth()->user()->can('edit', $option);
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

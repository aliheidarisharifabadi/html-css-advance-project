<?php

namespace App\Http\Requests\v1\Common\Option;

use App\Http\Requests\SetRequest;
use App\Models\Common\Option;

/**
 * Class OptionIndexRequest
 *
 * @package App\Http\Requests\v1\Common\Option
 */
class OptionIndexRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with option.index permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('index', Option::class);
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


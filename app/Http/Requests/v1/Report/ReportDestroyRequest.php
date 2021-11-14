<?php

namespace App\Http\Requests\v1\Report;

use App\Http\Requests\SetRequest;

/**
 * Class ReportDestroyRequest
 *
 * @package App\Http\Requests\v1\Report
 *
 */
class ReportDestroyRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$report = $this->route('report');

		return auth()->user()->can('report.destroy', $report);
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


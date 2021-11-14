<?php

namespace App\Http\Requests\v1\Report;

use App\Http\Requests\SetRequest;

/**
 * Class ReportStatusRequest
 *
 * @package App\Http\Requests\v1\Report
 *
 * @property boolean $status
 */
class ReportStatusRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$report = $this->route('report');

		return auth()->user()->can('report.status', $report);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'status' => 'required|integer|in:0,1',
		];
	}
}


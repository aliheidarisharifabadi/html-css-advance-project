<?php

namespace App\Http\Requests\v1\Report;

use App\Http\Requests\SetRequest;
use App\Models\VisitCard\Report;

/**
 * Class ReportIndexRequest
 *
 * @package App\Http\Requests\v1\Report
 *
 */
class ReportIndexRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('report.index', Report::class);
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


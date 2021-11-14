<?php

namespace App\Http\Requests\v1\Report;

use App\Http\Requests\SetRequest;
use App\Models\VisitCard\Report;

/**
 * Class ReportStoreRequest
 *
 * @package App\Http\Requests\v1\Report
 *
 * @property integer $vcard_id
 * @property string  $reason
 * @property integer $anger
 */
class ReportStoreRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('report.report', Report::class);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'vcard_id' => 'required|integer|exists:visit_cards,id',
			'reason'   => 'required|string|min:15|max:190',
			'anger'    => 'required|integer|in:1,2,3,4,5,6,7,8,9,10',
		];
	}
}


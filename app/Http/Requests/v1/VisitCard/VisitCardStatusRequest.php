<?php

namespace App\Http\Requests\v1\VisitCard;

use App\Http\Requests\SetRequest;

/**
 * Class VisitCardStatusRequest
 *
 * @package App\Http\Requests\v1\VisitCard
 *
 * @property boolean $status
 */
class VisitCardStatusRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$vcard = $this->route('vcard');

		return auth()->user()->can('visitCard.status', $vcard);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'status' => 'required|in:0,1',
		];
	}
}


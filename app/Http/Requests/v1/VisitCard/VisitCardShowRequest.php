<?php

namespace App\Http\Requests\v1\VisitCard;

use App\Http\Requests\SetRequest;

/**
 * Class VisitCardShowRequest
 *
 * @package App\Http\Requests\v1\VisitCard
 *
 */
class VisitCardShowRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$vcard = $this->route('vcard');

		return auth()->user()->can('visitCard.show', $vcard);
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


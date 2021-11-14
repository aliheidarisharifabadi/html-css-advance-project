<?php

namespace App\Http\Requests\v1\VisitCard;

use App\Http\Requests\SetRequest;

/**
 * Class VisitCardEditRequest
 *
 * @package App\Http\Requests\v1\VisitCard
 *
 */
class VisitCardEditRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$vcard = $this->route('vcard');

		return auth()->user()->can('visitCard.edit', $vcard);
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


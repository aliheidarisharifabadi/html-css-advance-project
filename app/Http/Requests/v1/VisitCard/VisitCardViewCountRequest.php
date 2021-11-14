<?php

namespace App\Http\Requests\v1\VisitCard;

use App\Http\Requests\SetRequest;

/**
 * Class VisitCardViewCountRequest
 *
 * @package App\Http\Requests\v1\VisitCard
 *
 */
class VisitCardViewCountRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$vcard = $this->route('vcard');

		return auth()->user()->can('visitCard.viewCount', $vcard);
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


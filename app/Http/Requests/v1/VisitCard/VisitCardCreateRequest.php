<?php

namespace App\Http\Requests\v1\VisitCard;

use App\Http\Requests\SetRequest;
use App\Models\VisitCard\VisitCard;

/**
 * Class VisitCardCreateRequest
 *
 * @package App\Http\Requests\v1\VisitCard
 *
 */
class VisitCardCreateRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('visitCard.create', VisitCard::class);
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


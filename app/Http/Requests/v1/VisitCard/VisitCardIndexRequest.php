<?php

namespace App\Http\Requests\v1\VisitCard;

use App\Http\Requests\SetRequest;
use App\Models\VisitCard\VisitCard;

/**
 * Class VisitCardIndexRequest
 *
 * @package App\Http\Requests\v1\VisitCard
 *
 */
class VisitCardIndexRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('visitCard.index', VisitCard::class);
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


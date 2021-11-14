<?php

namespace App\Http\Requests\Admin\VisitCard;

use App\Models\VisitCard\VisitCard;
use Illuminate\Foundation\Http\FormRequest;

class AdminVisitCardIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	return true;
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

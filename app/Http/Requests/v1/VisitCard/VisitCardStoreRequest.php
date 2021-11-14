<?php

namespace App\Http\Requests\v1\VisitCard;

use App\Http\Requests\SetRequest;
use App\Models\VisitCard\VisitCard;
use Illuminate\Http\File;

/**
 * Class VisitCardStoreRequest
 *
 * @package App\Http\Requests\v1\VisitCard
 *
 * @property integer   $user_id
 * @property File      $photo
 * @property string    $title
 * @property string    $specialty
 * @property string    $description
 * @property integer[] $categories
 * @property integer[] $socials
 * @property integer   $zone
 * @property integer   $state
 * @property integer   $city
 * @property string    $address
 * @property string    $phone
 */
class VisitCardStoreRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('visitCard.store', VisitCard::class);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'user_id'      => 'sometimes|integer|exists:users,id',
			'photo'        => 'sometimes|image|mimes:jpeg,jpg,png|max:200',
			'title'        => 'required|string|min:4|max:190',
			'specialty'    => 'required|string|min:2|max:190',
			'description'  => 'sometimes|string|min:15',
			'categories'   => 'required|array|min:1|exists:categories,id',
			'categories.*' => 'required|integer|exists:categories,id',
			'socials'      => 'required|array|min:1|exists:socials,id',
			'socials.*'    => 'required|integer|exists:socials,id',
			'zone'         => 'sometimes|integer|exists:zones,id',
			'state'        => 'sometimes|integer|exists:states,id',
			'city'         => 'sometimes|integer|exists:cities,id',
			'address'      => 'sometimes|string|min:2|max:190',
			'phone'        => 'sometimes|phone',
		];
	}
}


<?php

namespace App\Http\Requests\v1\VisitCard;

use App\Http\Requests\SetRequest;
use Illuminate\Http\File;

/**
 * Class VisitCardUpdateRequest
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
class VisitCardUpdateRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$vcard = $this->route('vcard');

		return auth()->user()->can('visitCard.update', $vcard);
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
			'title'        => 'sometimes|string|min:4|max:190',
			'specialty'    => 'sometimes|string|min:2|max:190',
			'description'  => 'sometimes|string|min:15',
			'categories'   => 'sometimes|array|min:1|exists:categories,id',
			'categories.*' => 'sometimes|exists:categories,id',
			'socials'      => 'sometimes|array|min:1|exists:socials,id',
			'socials.*'    => 'sometimes|exists:socials,id',
			'zone'         => 'sometimes|integer|exists:zones,id',
			'state'        => 'sometimes|integer|exists:states,id',
			'city'         => 'sometimes|integer|exists:cities,id',
			'address'      => 'sometimes|string|min:2|max:190',
			'phone'        => 'sometimes|phone',
		];
	}
}


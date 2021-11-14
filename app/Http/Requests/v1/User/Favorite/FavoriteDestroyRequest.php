<?php

namespace App\Http\Requests\v1\User\Favorite;

use App\Http\Requests\SetRequest;

/**
 * Class FavoriteDestroyRequest
 *
 * @package App\Http\Requests\v1\User\Favorite
 *
 * @property integer $vcard_id
 */
class FavoriteDestroyRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with profile.show permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$favorite = $this->route('favorite');

		return auth()->user()->can('favorite.destroy', $favorite);
	}

	/**
	 * @return array of rules
	 */
	public function rules()
	{
		return [
			'vcard_id' => 'required|integer|exists:visit_cards,id'
		];
	}

}

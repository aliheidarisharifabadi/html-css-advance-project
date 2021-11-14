<?php

namespace App\Http\Requests\v1\User\Favorite;

use App\Http\Requests\SetRequest;
use App\Models\User\Favorite;

/**
 * Class FavoriteStoreRequest
 *
 * @package App\Http\Requests\v1\User\Favorite
 *
 * @property integer $vcard_id
 */
class FavoriteStoreRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with profile.show permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('favorite.store', Favorite::class);
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

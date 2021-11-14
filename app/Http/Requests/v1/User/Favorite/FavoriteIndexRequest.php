<?php

namespace App\Http\Requests\v1\User\Favorite;

use App\Http\Requests\SetRequest;
use App\Models\User\Favorite;

/**
 * Class FavoriteIndexRequest
 *
 * @package App\Http\Requests\v1\User\Favorite
 */
class FavoriteIndexRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with profile.show permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('favorite.index', Favorite::class);
	}

	/**
	 * @return array of rules
	 */
	public function rules()
	{
		return [
			//
		];
	}

}

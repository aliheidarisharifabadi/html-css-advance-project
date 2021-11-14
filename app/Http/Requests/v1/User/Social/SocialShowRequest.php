<?php

namespace App\Http\Requests\v1\User\Social;

use App\Http\Requests\SetRequest;;

/**
 * Class SocialShowRequest
 *
 * @package App\Http\Requests\v1\User\Social
 */
class SocialShowRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with profile.show permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$social = $this->route('social');

		return auth()->user()->can('social.show', $social);
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

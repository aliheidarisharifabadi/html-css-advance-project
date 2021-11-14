<?php

namespace App\Http\Requests\v1\User\Social;

use App\Http\Requests\SetRequest;

/**
 * Class SocialStatusRequest
 *
 * @package App\Http\Requests\v1\User\Social
 *
 * @property boolean $status
 */
class SocialStatusRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with profile.show permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$social = $this->route('social');

		return auth()->user()->can('social.status', $social);
	}

	/**
	 * @return array of rules
	 */
	public function rules()
	{
		return [
			'status' => 'required|in:0,1',
		];
	}

}

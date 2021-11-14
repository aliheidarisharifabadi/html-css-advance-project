<?php

namespace App\Http\Requests\v1\User\Social;

use App\Http\Requests\SetRequest;
use App\Models\User\Social;

/**
 * Class SocialIndexRequest
 *
 * @package App\Http\Requests\v1\User\Social
 *
 */
class SocialIndexRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with profile.show permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('social.index', Social::class);
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

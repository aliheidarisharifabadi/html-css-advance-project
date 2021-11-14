<?php

namespace App\Http\Requests\v1\User\Social;

use App\Http\Requests\SetRequest;
use App\Models\User\Social;
use Illuminate\Http\File;

/**
 * Class SocialUpdateRequest
 *
 * @package App\Http\Requests\v1\User\Social
 *
 * @property integer $user_id
 * @property File    $photo
 * @property string  $type
 * @property string  $value
 */
class SocialUpdateRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized with profile.show permission to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$social = $this->route('social');

		return auth()->user()->can('social.update', $social);
	}

	/**
	 * @return array of rules
	 */
	public function rules()
	{
		return [
			'user_id' => 'sometimes|integer|exists:users,id',
			'photo'   => 'sometimes|image|mimes:jpeg,jpg,png|max:200',
			'type'    => 'sometimes|string|in:' . implode(',', Social::TYPE_LIST),
			'value'   => 'sometimes|string|min:2|max:190',
		];
	}

}

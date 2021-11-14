<?php

namespace App\Http\Requests\v1\Common\Photo;

use App\Http\Requests\SetRequest;
use App\Models\Common\Photo;
use Illuminate\Http\File;

/**
 * Class AvatarStoreRequest
 *
 * @package App\Http\Requests\v1\Common\Photo
 *
 * @property File $photo
 */
class AvatarStoreRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('photo.storeAvatar', Photo::class);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'photo' => 'required|image|mimes:jpeg,jpg,png|max:200',
		];
	}
}

<?php

namespace App\Http\Requests\v1\Common\Photo;

use App\Http\Requests\SetRequest;
use Illuminate\Http\File;

/**
 * Class PhotoUpdateRequest
 *
 * @package App\Http\Requests\v1\Common\Photo
 *
 * @property File $photo
 */
class PhotoUpdateRequest extends SetRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$photo = $this->route('photo');

		return auth()->user()->can('photo.update', $photo);
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

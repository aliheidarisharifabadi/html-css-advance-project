<?php

namespace App\Http\Resources\v1\User\Favorite;

use App\Http\Resources\SetResource;
use App\Models\User\Favorite;

/**
 * Class FavoriteIndexResource
 *
 * @package App\Http\Resources\v1\User\Favorite
 *
 * @mixin Favorite
 *
 */
class FavoriteIndexResource extends SetResource
{
	protected $model = Favorite::class;

	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{

		return [
			'id'                        => $this->id,
			'vcard_id'                  => $this->visit_card_id,
			'vcard_title'               => $this->visitCard->title,
			'vcard_specialty'           => $this->visitCard->specialty,
			'vcard_photo_url'           => $this->visitCard->photo_url,
			'vcard_photo_thumbnail_url' => $this->visitCard->photo_thumbnail_url,
			'vcard_view_count'          => $this->visitCard->view_count,
			"zone"                      => $this->visitCard->getZoneName(),
		];
	}
}

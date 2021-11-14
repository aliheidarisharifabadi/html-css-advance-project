<?php

namespace App\Http\Resources\v1\Common\Category;

use App\Http\Resources\SetResource;
use App\Models\VisitCard\VisitCard;

/**
 * Class DashboardIndexResource
 *
 * @package App\Http\Resources\v1\Common\Category
 *
 * @mixin VisitCard
 *
 */
class CategoryGetVisitCardsResource extends SetResource
{
	protected $model = VisitCard::class;

	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			'id'                  => $this->id,
			'photo_url'           => $this->photo_url,
			'photo_thumbnail_url' => $this->photo_thumbnail_url,
			'title'               => $this->title,
			'specialty'           => $this->specialty,
			'description'         => $this->description,
			'view_count'          => $this->view_count,
			'is_favorite'         => $this->isFavoriteUser(),
			"zone"                => $this->getZoneName(),
		];
	}
}

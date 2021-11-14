<?php

namespace App\Http\Resources\v1\Dashboard;

use App\Http\Resources\SetResource;
use App\Models\VisitCard\VisitCard;

/**
 * Class DashboardShowResource
 *
 * @package App\Http\Resources\v1\Dashboard
 *
 * @mixin VisitCard
 *
 */
class DashboardShowResource extends SetResource
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
		$id = auth()->id();

		return [
			'id'                  => $this->id,
			'photo_url'           => $this->photo_url,
			'photo_thumbnail_url' => $this->photo_thumbnail_url,
			'title'               => $this->title,
			'specialty'           => $this->specialty,
			'description'         => $this->description,
			'view_count'          => $this->view_count,
			$this->mergeWhen($id, [
				'is_favorite' => $this->isFavoriteUser($id),
			]),
			'zone'                => $this->getZoneName(),
			'socials'             => $this->getSocials(),
		];
	}
}

<?php

namespace App\Http\Resources\v1\VisitCard;

use App\Http\Resources\SetResource;
use App\Models\User\User;
use App\Models\VisitCard\VisitCard;

/**
 * Class VisitCardIndexResource
 *
 * @package App\Http\Resources\v1\VisitCard
 *
 * @mixin VisitCard
 *
 */
class VisitCardIndexResource extends SetResource
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
		$role = auth()->user()->canUser('visitCard.index');

		return [
			'id'                  => $this->id,
			'photo_url'           => $this->photo_url,
			'photo_thumbnail_url' => $this->photo_thumbnail_url,
			'title'               => $this->title,
			'specialty'           => $this->specialty,
			'description'         => $this->description,
			'view_count'          => $this->view_count,
			'is_favorite'         => $this->isFavoriteUser(),
			$this->mergeWhen($role == User::ROLE_ADMIN, [
				'user_id'    => $this->user_id,
				'user_phone' => $this->user->phone,
				'status'     => $this->status,
				'deleted_at' => $this->deleted_at,
			]),
			"zone"                => $this->getZoneName(),
		];
	}
}

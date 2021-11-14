<?php

namespace App\Http\Resources\v1\VisitCard;

use App\Http\Resources\SetResource;
use App\Models\VisitCard\Report;

/**
 * Class ReportIndexResource
 *
 * @package App\Http\Resources\v1\VisitCard
 *
 * @mixin Report
 *
 */
class ReportIndexResource extends SetResource
{
	protected $model = Report::class;

	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			'id'              => $this->id,
			'f_user'          => $this->user->first_name,
			'l_user'          => $this->user->last_name,
			'vcard_title'     => $this->visitCard->title,
			'vcard_specialty' => $this->visitCard->specialty,
			'reason'          => $this->reason,
			'anger'           => $this->anger,
			'status'          => $this->status,
		];
	}
}

<?php

namespace App\Http\Resources\v1\Location\State;

use App\Http\Resources\SetResource;
use App\Models\Location\State;

/**
 * Class StateShowResource
 *
 * @package App\Http\Resources\v1\Common
 * @mixin State
 */
class StateShowResource extends SetResource
{

	protected $model = State::class;

	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			"id"     => $this->id,
			"name"   => $this->name,
			"cities" => $this->cities,
		];
	}

}

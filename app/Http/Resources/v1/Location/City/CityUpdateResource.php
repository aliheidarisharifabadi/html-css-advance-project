<?php

namespace App\Http\Resources\v1\Location\City;

use App\Http\Resources\SetResource;
use App\Models\Location\City;

/**
 * Class CityStoreResource
 *
 * @package App\Http\Resources\v1\Location\City
 * @mixin City
 */
class CityUpdateResource extends SetResource
{
	protected $model = City::class;

	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			"id"   => $this->id,
			"name" => $this->name,
		];
	}

}

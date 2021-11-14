<?php

namespace App\Http\Controllers\v1\Location;

use App\Http\Requests\v1\Location\City\CityShowRequest;
use App\Http\Requests\v1\Location\City\CityStoreRequest;
use App\Http\Requests\v1\Location\City\CityUpdateRequest;
use App\Http\Resources\v1\Location\City\CityShowResource;
use App\Http\Resources\v1\Location\City\CityUpdateResource;
use App\Models\Location\City;
use App\Http\Resources\v1\Location\City\CityStoreResource;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CityStoreRequest $request
	 * @return CityStoreResource
	 * @throws \Exception
	 */
	public function store(CityStoreRequest $request)
	{
		/** @var City $city */
		$city = City::create([
			'state_id' => $request->state_id,
			'name'     => $request->name,
		]);

		return new CityStoreResource($city, true, trans('messages.city.created'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param CityShowRequest $request
	 * @param City            $city
	 * @return CityShowResource
	 * @throws \Exception
	 */
	public function show(CityShowRequest $request, City $city)
	{
		return new CityShowResource($city, true, trans('messages.city.shown'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  CityUpdateRequest         $request
	 * @param  \App\Models\Location\City $city
	 * @return CityUpdateResource
	 * @throws \Exception
	 */
	public function update(CityUpdateRequest $request, City $city)
	{
		$city->update($request->only('state_id', 'name'));

		return new CityUpdateResource($city, true, trans('messages.city.updated'));
	}
}

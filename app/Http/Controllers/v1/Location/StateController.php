<?php

namespace App\Http\Controllers\v1\Location;

use App\Http\Requests\v1\Location\State\{
	StateIndexRequest,
	StateShowCitiesRequest,
	StateShowRequest,
	StateStoreRequest,
	StateTreeRequest,
	StateUpdateRequest
};
use App\Http\Resources\v1\Location\City\CityStoreResource;
use App\Http\Resources\v1\Location\State\{
	StateIndexResource,
	StateShowResource,
	StateStoreResource,
	StateUpdateResource
};
use App\Http\Controllers\Controller;
use App\Models\Location\State;

class StateController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param StateIndexRequest $request
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(StateIndexRequest $request)
	{
		/** @var State $states */
		$query = State::query();

		return StateIndexResource::collection($query->select(['id', 'name'])->get())->additional([
			'success' => true,
			'message' => '',
		]);
	}

	/**
	 * @param StateShowCitiesRequest $request
	 * @param State                  $state
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function cities(StateShowCitiesRequest $request, State $state)
	{
		return CityStoreResource::collection($state->cities)->additional([
			'success'  => true,
			'message' => '',
		]);
	}

	/**
	 * @param StateTreeRequest $request
	 * @return mixed
	 * @throws \Exception
	 */
	public function tree(StateTreeRequest $request)
	{
		return StateShowResource::collection(State::all())->additional([
			'success'  => true,
			'message' => '',
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param StateStoreRequest $request
	 * @return StateStoreResource
	 * @throws \Exception
	 */
	public function store(StateStoreRequest $request)
	{
		/** @var State $state */
		$state = State::create([
			'name' => $request->name,
		]);

		return new StateStoreResource($state, true, trans('messages.state.created'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param StateShowRequest $request
	 * @param State            $state
	 * @return StateShowResource
	 * @throws \Exception
	 */
	public function show(StateShowRequest $request, State $state)
	{
		return new StateShowResource($state, true, trans('messages.state.shown'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  StateUpdateRequest         $request
	 * @param  \App\Models\Location\State $state
	 * @return StateUpdateResource
	 * @throws \Exception
	 */
	public function update(StateUpdateRequest $request, State $state)
	{
		$state->update($request->only(['name']));

		return new StateUpdateResource($state, true, trans('messages.state.updated'));
	}

}

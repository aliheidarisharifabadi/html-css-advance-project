<?php

namespace App\Http\Controllers\v1\Common;

use App\Http\Requests\v1\Common\Option\OptionEditRequest;
use App\Http\Requests\v1\Common\Option\OptionIndexRequest;
use App\Http\Requests\v1\Common\Option\OptionShowRequest;
use App\Http\Requests\v1\Common\Option\OptionStoreRequest;
use App\Http\Requests\v1\Common\Option\OptionUpdateRequest;
use App\Http\Resources\ActionResource;
use App\Http\Resources\v1\Common\Option\OptionEditResource;
use App\Http\Resources\v1\Common\Option\OptionIndexResource;
use App\Http\Resources\v1\Common\Option\OptionShowResource;
use App\Models\Common\Option;
use App\Http\Controllers\Controller;

class OptionController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @param OptionIndexRequest $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(OptionIndexRequest $request)
	{
        /** @var Option $options */
        $options = Option::query();

        $per_page = Option::get('option.index.paginate', 20);

        return OptionIndexResource::collection($options->paginate($per_page));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param OptionStoreRequest $request
	 * @return ActionResource|\Illuminate\Http\Response
	 */
	public function store(OptionStoreRequest $request)
	{
		Option::add($request->name, $request->value);

		return new ActionResource(trans('messages.option.store'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param OptionShowRequest          $request
	 * @param  \App\Models\Common\Option $option
	 * @return OptionShowResource
	 * @throws \Exception
	 */
	public function show(OptionShowRequest $request, Option $option)
	{
		return new OptionShowResource($option, trans('messages.option.show'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param OptionEditRequest          $request
	 * @param  \App\Models\Common\Option $option
	 * @return OptionEditResource
	 * @throws \Exception
	 */
	public function edit(OptionEditRequest $request, Option $option)
	{
		return new OptionEditResource($option, trans('messages.option.show'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param OptionUpdateRequest        $request
	 * @param  \App\Models\Common\Option $option
	 * @return ActionResource
	 */
	public function update(OptionUpdateRequest $request, Option $option)
	{
		$option->update([
			'value' => $request->value,
		]);

		return ActionResource(trans('messages.option.update'));
	}

}

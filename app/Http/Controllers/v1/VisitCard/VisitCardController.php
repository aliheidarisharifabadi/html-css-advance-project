<?php

namespace App\Http\Controllers\v1\VisitCard;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\VisitCard\VisitCardCreateRequest;
use App\Http\Requests\v1\VisitCard\VisitCardEditRequest;
use App\Http\Requests\v1\VisitCard\VisitCardIndexRequest;
use App\Http\Requests\v1\VisitCard\VisitCardShowRequest;
use App\Http\Requests\v1\VisitCard\VisitCardStatusRequest;
use App\Http\Requests\v1\VisitCard\VisitCardStoreRequest;
use App\Http\Requests\v1\VisitCard\VisitCardUpdateRequest;
use App\Http\Requests\v1\VisitCard\VisitCardViewCountRequest;
use App\Http\Resources\v1\VisitCard\VisitCardEditResource;
use App\Http\Resources\v1\VisitCard\VisitCardIndexResource;
use App\Http\Resources\v1\VisitCard\VisitCardShowResource;
use App\Models\Common\Category;
use App\Models\Common\Option;
use App\Models\Common\Photo;
use App\Models\Location\State;
use App\Models\Location\Zone;
use App\Models\User\Social;
use App\Models\User\User;
use App\Models\VisitCard\VisitCard;

class VisitCardController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param VisitCardIndexRequest $request
	 * @return \App\Http\Resources\ActionResource|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(VisitCardIndexRequest $request)
	{
		/** @var VisitCard $query */
		$query = VisitCard::query();

		/** @var User $user */
		$user = auth()->user();

		$per_page = Option::get('visitCard.index.paginate', 20);

		/** @var VisitCard[] $visitCards */
		$visitCards = [];

		$role = $user->canUser('visitCard.index');

		if ($role == User::ROLE_ADMIN) {

			$visitCards = $query->paginate($per_page);

		} elseif ($role == User::ROLE_USER) {

			$visitCards = $query->Mine()->get();

		} else {

			return ActionResource(trans('messages.exception.not_access'), false);

		}

		return VisitCardIndexResource::collection($visitCards)->additional([
			'success' => true,
			'message' => '',
		]);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param VisitCardCreateRequest $request
	 * @return \App\Http\Resources\ActionResource
	 */
	public function create(VisitCardCreateRequest $request)
	{
		/** @var User $user */
		$user = auth()->user();

		$data = [
			'categories' => Category::treeData(),
			'socials'    => $user->socials,
			'zones'      => $user->zones,
			'states'     => State::all(),
		];

		return ActionResource(trans('messages.visitCard.create'), true, $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param VisitCardStoreRequest $request
	 * @return \App\Http\Resources\ActionResource
	 */
	public function store(VisitCardStoreRequest $request)
	{
		/** @var User $user */
		$user = auth()->user();

		if (!$user->can_create_vcard) {

			return ActionResource(trans('messages.visitCard.initSale'), false);

		}

		if (isset($request->user_id)) {

			if (!$user->hasRole(User::ROLE_ADMIN)) {

				return ActionResource(trans('messages.exception.not_access'), false);

			}
			/** @var User $userVisitCard */
			$userVisitCard = User::where('id', $request->user_id)->first();

		} else {
			$userVisitCard = $user;
		}

		/** @var integer[] $categories */
		$categories = [];

		/** @var Category $cat */
		foreach (array_unique($request->categories) as $cat) {

			$category = Category::find($cat);

			if ($category->parent_id != NULL) {

				array_push($categories, $cat);

			}

		}

		if (!$categories) {

			return ActionResource(trans('messages.category.notValid'), false);

		}

		foreach (array_unique($request->socials) as $social) {

			if ($userVisitCard->id != Social::where('id', $social)->first()->id) {

				return ActionResource(trans('messages.social.notValid'), false);

			}

		}

		if (!isset($request->zone)) {

			if (!isset($request->state) || !isset($request->city) || !isset($request->address)) {

				return ActionResource(trans('messages.visitCard.requiredAddress'), false);

			}

		}

		if ($request->hasFile('photo')) {
			/** @var Photo $photo */
			$photo = Photo::create([
				'user_id'   => $userVisitCard->id,
				'disk'      => Photo::DISK_LOCAL,
				'thumbnail' => photoUploader($request->file('photo'), Photo::TYPE_THUMBNAIL, mt_rand(10, 99)),
				'path'      => photoUploader($request->file('photo'), Photo::TYPE_V_CARD, mt_rand(10, 99)),
				'ext'       => $request->file('photo')->getClientOriginalExtension(),
				'type'      => Photo::TYPE_V_CARD,
			]);
		}

		/** @var VisitCard $vcard */
		$vcard = VisitCard::create([
			'user_id'     => $userVisitCard->id,
			'photo_id'    => isset($photo) ? $photo->id : NULL,
			'title'       => $request->title,
			'specialty'   => $request->specialty,
			'description' => $request->description,
		]);

		/** attach selected categories in to visitCard */
		$vcard->categories()->attach($categories);

		/** attach selected socials in to visitCard */
		$vcard->socials()->attach(array_unique($request->socials));

		if (isset($request->zone)) {

			$vcard->zones()->attach(array($request->zone));

		} else {

			$zone = Zone::create([
				'user_id'  => $userVisitCard->id,
				'state_id' => $request->state,
				'city_id'  => $request->city,
				'address'  => $request->address,
				'phone'    => $request->phone ?? $userVisitCard->phone,
			]);

			$vcard->zones()->attach(array($zone->id));

		}

		$user->can_create_vcard = false;
		$user->save();

		return ActionResource(trans('messages.visitCard.stored'), true);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param VisitCardShowRequest $request
	 * @param VisitCard            $vcard
	 * @return \App\Http\Resources\ActionResource|VisitCardShowResource
	 * @throws \Exception
	 */
	public function show(VisitCardShowRequest $request, VisitCard $vcard)
	{
		/** @var User $user */
		$user = auth()->user();

		$role = $user->canUser('visitCard.show');

		if ($role == User::ROLE_USER) {

			if ($vcard->user_id != $user->id) {

				return ActionResource(trans('messages.visitCard.notExist'), false);

			}

		}

		return new VisitCardShowResource($vcard);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param VisitCardEditRequest             $request
	 * @param  \App\Models\VisitCard\VisitCard $vcard
	 * @return \App\Http\Resources\ActionResource|VisitCardEditResource
	 * @throws \Exception
	 */
	public function edit(VisitCardEditRequest $request, VisitCard $vcard)
	{
		/** @var User $user */
		$user = auth()->user();

		$role = $user->canUser('visitCard.edit');

		if ($role == User::ROLE_USER) {

			if ($vcard->user_id != $user->id) {

				return ActionResource(trans('messages.visitCard.notExist'), false);

			}

		}

		return new VisitCardEditResource($vcard);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param VisitCardUpdateRequest $request
	 * @param VisitCard              $vcard
	 * @return \App\Http\Resources\ActionResource
	 */
	public function update(VisitCardUpdateRequest $request, VisitCard $vcard)
	{
		/** @var User $user */
		$user = auth()->user();

		if (isset($request->user_id)) {

			if (!$user->hasRole(User::ROLE_ADMIN)) {

				return ActionResource(trans('messages.exception.not_access'), false);

			}
			/** @var User $userVisitCard */
			$userVisitCard = User::where('id', $request->user_id)->first();

		} else {
			$userVisitCard = $user;
		}

		if (isset($request->state) || isset($request->city) || isset($request->address)) {

			if (!isset($request->state) || !isset($request->city) || !isset($request->address)) {

				return ActionResource(trans('messages.visitCard.requiredAddress'), false);

			}

		}

		$data = $request->only([
			'title',
			'specialty',
			'description',
		]);

		if ($request->hasFile('photo')) {

			/** @var Photo $photo */
			$photo = Photo::create([
				'user_id'   => $userVisitCard->id,
				'disk'      => Photo::DISK_LOCAL,
				'thumbnail' => photoUploader($request->file('photo'), Photo::TYPE_THUMBNAIL, mt_rand(10, 99)),
				'path'      => photoUploader($request->file('photo'), Photo::TYPE_V_CARD, mt_rand(10, 99)),
				'ext'       => $request->file('photo')->getClientOriginalExtension(),
				'type'      => Photo::TYPE_V_CARD,
			]);

			if (isset($vcard->photo_id)) {

				if (file_exists(storage_path($vcard->photo->path))) {

					unlink(storage_path($vcard->photo->path));

				}

				if (file_exists(storage_path($vcard->photo->thumbnail))) {

					unlink(storage_path($vcard->photo->thumbnail));

				}

			}

			$data = array_merge($data, ['photo_id' => $photo->id]);

		}

		/** update package info */
		$vcard->update($data);


		if (isset($request->categories)) {

			/** @var integer[] $categories */
			$categories = [];

			/** @var Category $cat */
			foreach (array_unique($request->categories) as $cat) {

				$category = Category::find($cat);

				if ($category->parent_id != NULL) {

					array_push($categories, $cat);

				}

			}

			if ($categories->emptyArray()) {

				return ActionResource(trans('messages.category.notValid'), false);

			}

			/** sync selected category in to package */
			$vcard->categories()->sync($categories);

		}

		if (isset($request->socials)) {

			/** sync selected socials in to visitCard */
			$vcard->socials()->sync(array_unique($request->socials));

		}

		if (isset($request->zone)) {

			$vcard->zones()->sync(array($request->zone));

		} else {


			$zone = Zone::create([
				'user_id'  => $userVisitCard->id,
				'state_id' => $request->state,
				'city_id'  => $request->city,
				'address'  => $request->address,
				'phone'    => $request->phone ?? $userVisitCard->phone,
			]);

			$vcard->zones()->attach(array($zone->id));

		}

		return ActionResource(trans('messages.visitCard.updated'), true);
	}

	/**
	 * @param VisitCardStatusRequest $request
	 * @param VisitCard              $vcard
	 * @return \App\Http\Resources\ActionResource
	 */
	public function status(VisitCardStatusRequest $request, VisitCard $vcard)
	{
		/** @var User $user */
		$user = auth()->user();

		if ($vcard->user_id != $user->id) {

			return ActionResource(trans('messages.visitCard.notExist'), false);

		}

		if ($vcard->status == $request->status) {

			return ActionResource(trans('messages.visitCard.invalidStatus'), false);

		}

		$vcard->status = $request->status;
		$vcard->save();

		return ActionResource(trans('messages.visitCard.updatedStatus'), true);
	}

	/**
	 * @param VisitCardViewCountRequest $request
	 * @param VisitCard                 $vcard
	 * @return \App\Http\Resources\ActionResource
	 */
	public function viewCount(VisitCardViewCountRequest $request, VisitCard $vcard)
	{
		/** @var User $user */
		$user = auth()->user();

		if ($vcard->status == false) {

			return ActionResource(trans('messages.visitCard.notExist'), false);

		}


		if ($vcard->isUserSeen()){

			return ActionResource(trans('messages.visitCard.isUserSeenFail'), false);

		}

		$vcard->users()->attach(array($user->id));

		$vcard->view_count++;
		$vcard->save();

		return ActionResource(trans('messages.visitCard.isUserSeenSuccess'), true);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\VisitCard\VisitCard $vcard
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(VisitCard $vcard)
	{
		//
	}
}

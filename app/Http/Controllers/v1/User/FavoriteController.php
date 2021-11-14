<?php

namespace App\Http\Controllers\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\User\Favorite\FavoriteDestroyRequest;
use App\Http\Requests\v1\User\Favorite\FavoriteIndexRequest;
use App\Http\Requests\v1\User\Favorite\FavoriteStoreRequest;
use App\Http\Resources\v1\User\Favorite\FavoriteIndexResource;
use App\Models\Common\Option;
use App\Models\User\Favorite;
use App\Models\User\User;

class FavoriteController extends Controller
{
	/**
	 * @param FavoriteIndexRequest $request \
	 * @return \App\Http\Resources\ActionResource|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(FavoriteIndexRequest $request)
	{
		/** @var User $user */
		$user = auth()->user();

		/** @var Favorite $query */
		$query = Favorite::query();

		$per_page = Option::get('favorite.index.paginate', 20);

		/** @var Favorite[] $favorites */
		$favorites = [];

		$role = $user->canUser('favorite.index');

		if ($role == User::ROLE_ADMIN) {

			$favorites = $query->latest()->paginate($per_page);

		} elseif ($role == User::ROLE_USER) {

			$favorites = $packages = $query->Mine()->latest()->whereHas('visitCard', function ($query) {
				$query->where('status', '=', true);
			})->paginate($per_page);

		} else {

			return ActionResource(trans('messages.exception.not_access'), false);

		}

		return FavoriteIndexResource::collection($favorites)->additional([
			'success' => true,
			'message' => '',
		]);
	}

	/**
	 * @param FavoriteStoreRequest $request
	 * @return \App\Http\Resources\ActionResource
	 */
	public function store(FavoriteStoreRequest $request)
	{
		/** @var User $user */
		$user = auth()->user();

		$key = [
			'user_id'       => $user->id,
			'visit_card_id' => $request->vcard_id,
		];

		/** @var Favorite $favorite */
		$favorite = Favorite::where($key)->first();

		if ($favorite){

			return ActionResource(trans('messages.visitCard.alreadyFavorite'), false);

		}

		Favorite::create($key);

		return ActionResource(trans('messages.favorite.stored'), true);
	}

	/**
	 * @param FavoriteDestroyRequest $request
	 * @param Favorite               $favorite
	 * @return \App\Http\Resources\ActionResource
	 * @throws \Exception
	 */
	public function destroy(FavoriteDestroyRequest $request, Favorite $favorite)
	{
		/** @var User $user */
		$user = auth()->user();

		if ($favorite->visit_card_id != $request->vcard_id){

			return ActionResource(trans('messages.favorite.invalid'), false);

		}

		if ($user->id != $favorite->user_id){

			return ActionResource(trans('messages.favorite.invalidNotYou'), false);

		}

		$favorite->delete();

		return ActionResource(trans('messages.favorite.deleted'), true);
	}
}

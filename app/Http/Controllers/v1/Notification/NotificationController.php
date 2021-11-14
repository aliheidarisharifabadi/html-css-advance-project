<?php

namespace App\Http\Controllers\v1\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Notification\NotificationClickRequest;
use App\Http\Requests\v1\Notification\NotificationDeliverRequest;
use App\Http\Requests\v1\Notification\NotificationIndexRequest;
use App\Http\Resources\v1\Notification\NotificationIndexResource;
use App\Models\Common\Option;
use App\Models\Notification\Notification;
use App\Models\User\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param NotificationIndexRequest $request
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(NotificationIndexRequest $request)
	{
		/** @var Notification $query */
		$query = Notification::query();

		/** @var User $user */
		$user = auth()->user();

		$per_page = Option::get('notification.index.paginate', 20);

		$role = $user->canUser('notification.index');

		$notifications = [];

		if ($role == User::ROLE_ADMIN) {
			// admin operation ...
			if (isset($request->user_id)) {
				$notifications = $query->where('provider_id', User::find($request->user_id)->provider_id)->latest()->paginate($per_page);

			} else {
				$notifications = $query->latest()->paginate($per_page);

			}

		} elseif ($role == User::ROLE_VISITOR) {
			// visitor operation ...
			$notifications = $query->where('provider_id', $user->provider_id)->latest()->paginate($per_page);

		} elseif ($role == User::ROLE_CUSTOMER) {
			// customer operation ...

		} else {

			return ActionResource(trans('messages.exception.not_access'), false);

		}

		return NotificationIndexResource::collection($notifications)->additional([
			'success' => true,
			'message' => '',
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Notification\Notification $notification
	 * @return \Illuminate\Http\Response
	 */
	public function show(Notification $notification)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Notification\Notification $notification
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Notification $notification)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request              $request
	 * @param  \App\Models\Notification\Notification $notification
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Notification $notification)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Notification\Notification $notification
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Notification $notification)
	{
		//
	}

	/**
	 * @param NotificationDeliverRequest $request
	 * @return \App\Http\Resources\ActionResource
	 */
	public function deliver(NotificationDeliverRequest $request)
	{
		/** @var User $user */
		$user = auth()->user();

		//@todo for user operation

		/** @var Notification $notification */
		$notification = Notification::find($request->notification_id);
		$notification->deliver_count++;
		$notification->save();

		return ActionResource(trans('messages.notification.deliver'), true);
	}

	/**
	 * @param NotificationClickRequest $request
	 * @return \App\Http\Resources\ActionResource
	 */
	public function click(NotificationClickRequest $request)
	{
		/** @var User $user */
		$user = auth()->user();

		//@todo for user operation

		/** @var Notification $notification */
		$notification = Notification::find($request->notification_id);
		$notification->click_count++;
		$notification->save();

		return ActionResource(trans('messages.notification.click'), true);
	}
}

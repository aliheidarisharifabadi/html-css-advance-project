<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notification\AdminNotificationIndexRequest;
use App\Http\Requests\Admin\Notification\AdminNotificationKeyRequest;
use App\Http\Requests\Admin\Notification\AdminNotificationKeyStoreRequest;
use App\Http\Requests\Admin\Notification\AdminNotificationKeyStatusRequest;
use App\Http\Requests\Admin\Notification\AdminNotificationShowRequest;
use App\Http\Requests\Admin\Notification\AdminNotificationStatusRequest;
use App\Models\Notification\Notification;
use App\Models\Notification\NotificationItem;
use App\Models\Notification\NotifItem;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
	/**
	 * @param AdminNotificationIndexRequest $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(AdminNotificationIndexRequest $request)
	{
		$title = trans('compact.notification.index.title');
		$subTitle = trans('compact.notification.index.subTitle');

		return view('admin.notification.index', compact('title', 'subTitle'));
	}

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function datatable()
	{
		/** @var Notification $query */
		$query = Notification::query();

		/** @var Notification[] $notifications */
		$notifications = $query->Active()->get();

		return DataTables::of($notifications)
			->editColumn('user', function ($notification) {
				return getUserFullName($notification->user_id);

			})->editColumn('type', function ($notification) {
				return '<span class="label label-purple">' . trans('models.notification.' . $notification->type) . '</span>';

			})->editColumn('click_count', function ($notification) {
				return '<span class="label label-inverse">' . $notification->click_count . '</span>';

			})->editColumn('deliver_count', function ($notification) {
				return '<span class="label label-inverse">' . $notification->deliver_count . '</span>';

			})->editColumn('date', function ($notification) {
				return '<span class="label label-info">' . $notification->j_created_at . '</span>';

			})->addColumn('action', function ($notification) {
//				$delLink = route('dashboard.category.destroy', ['user' => $notification->id]);
//				$delBtn = "<a href='#' class='btn btn-xs red'><i class='fa fa-trash' style='font-size: 20px;'></i></a>";

				$showLink = route('notification.show', ['notification' => $notification->id]);
				$showBtn = "<a href='$showLink' class='btn btn-xs red'><i class='fa fa-eye' style='font-size: 20px;'></i></a>";

				$statusLink = route('notification.status', ['notification' => $notification->id]);
				if ($notification->status) {
					$activeBtn = "<a href='$statusLink' class='btn btn-xs success'><i class='fa fa-flag' style='font-size: 20px'></i></a>";
				} else {
					$activeBtn = "<a href='#$statusLink class='btn btn-xs red'><i class='fa fa-flag-o' style='font-size: 20px'></i></a>";
				}

//				return sprintf("%s\n%s", $activeBtn, $delBtn);
				return sprintf("%s\n%s", $activeBtn, $showBtn);

			})->rawColumns(['type', 'click_count', 'deliver_count', 'date', 'action'])
			->make(true);
	}

	public function create()
	{

	}
	public function store()
	{
		
	}

	public function show(AdminNotificationShowRequest $request, Notification $notification)
	{

	}

	/**
	 * @param AdminNotificationStatusRequest $request
	 * @param Notification                   $notification
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function status(AdminNotificationStatusRequest $request, Notification $notification)
	{
		if ($notification->status == true){

			alert()->warning(trans('compact.notification.sweet.status.body-warning'), trans('compact.notification.sweet.title.error'));

			return redirect()->back();

		}

		$notification->status = !$notification->status;
		$notification->save();

		alert()->success(trans('compact.notification.sweet.status.body'), trans('compact.notification.sweet.title.success'));

		return redirect()->back();
	}

	/**
	 * @param AdminNotificationKeyRequest $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function key(AdminNotificationKeyRequest $request)
	{
		$title = trans('compact.notification.key.title');
		$subTitle = trans('compact.notification.key.subTitle');

		return view('admin.notification.key', compact('title', 'subTitle'));
	}

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function keyDatatable()
	{
		/** @var NotifItem $query */
		$query = NotifItem::query();

		/** @var NotifItem[] $notifItems */
		$notifItems = $query->get();

		return DataTables::of($notifItems)
			->editColumn('key', function ($notifItem) {
				return $notifItem->key;

			})->editColumn('date', function ($notifItem) {
				return '<span class="label label-info">' . $notifItem->j_created_at . '</span>';

			})->editColumn('status', function ($notifItem) {
				if ($notifItem->status) {
					return '<span class="label label-success">فعال</span>';
				} else {
					return '<span class="label label-danger">غیرفعال</span>';
				}

			})->addColumn('action', function ($notifItem) {
//				$delLink = route('dashboard.category.destroy', ['user' => $notification->id]);
//				$delBtn = "<a href='#' class='btn btn-xs red'><i class='fa fa-trash' style='font-size: 20px;'></i></a>";

				$statusLink = route('notification.key.status', ['item' => $notifItem->id]);
				if ($notifItem->status) {
					$activeBtn = "<a href='$statusLink' class='btn btn-xs success'><i class='fa fa-flag' style='font-size: 20px'></i></a>";
				} else {
					$activeBtn = "<a href='$statusLink' class='btn btn-xs red'><i class='fa fa-flag-o' style='font-size: 20px'></i></a>";
				}

				return sprintf("%s", $activeBtn);

			})->rawColumns(['date', 'status', 'action'])
			->make(true);
	}

	/**
	 * @param AdminNotificationKeyStoreRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function keyStore(AdminNotificationKeyStoreRequest $request)
	{
		NotifItem::create([
			'type'   => Notification::TYPE_ADS_SYSTEM,
			'key'    => $request->key,
			'status' => isset($request->status),
		]);

		alert()->success(trans('compact.notification.sweet.keyStore.body'), trans('compact.notification.sweet.title.success'));

		return redirect()->back();
	}

	/**
	 * @param AdminNotificationKeyStatusRequest $request
	 * @param NotifItem                         $item
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function keyStatus(AdminNotificationKeyStatusRequest $request, NotifItem $item)
	{
		$item->status = !$item->status;
		$item->save();

		alert()->success(trans('compact.notification.sweet.keyStatus.body'), trans('compact.notification.sweet.title.success'));

		return redirect()->back();
	}
}

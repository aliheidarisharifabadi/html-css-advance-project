<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUserIndexBlackRequest;
use App\Http\Requests\Admin\User\AdminUserIndexRequest;
use App\Models\User\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
	/**
	 * @param AdminUserIndexRequest $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(AdminUserIndexRequest $request)
	{
		$title = trans('compact.user.index.title');
		$subTitle = trans('compact.user.index.subTitle');

		return view('admin.user.index', compact('title', 'subTitle'));
	}

	/**
	 * @param AdminUserIndexBlackRequest $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function indexBlack(AdminUserIndexBlackRequest $request)
	{
		$title = trans('compact.user.indexBlack.title');
		$subTitle = trans('compact.user.indexBlack.subTitle');

		return view('admin.user.blacklist', compact('title', 'subTitle'));
	}

	/**
	 * @param $type
	 * @return mixed
	 * @throws \Exception
	 */
	public function datatable($type)
	{
		/** @var User $query */
		$query = User::query();

		if ($type == User::TYPE_WHITE){
			/** @var User[] $users */
			$users = $query->Active()->get();

		}else if($type == User::TYPE_BLACK){
			/** @var User[] $users */
			$users = $query->NotActive()->get();

		}

		return DataTables::of($users)
			->editColumn('image', function ($user) {
				return '<img src="' . $user->photo_url . '" height="50px"/>';

			})->editColumn('fullname', function ($user) {
				return $user->first_name . ' ' . $user->last_name;

			})->editColumn('ref', function ($user) {
				$ref = isset($user->refer_id) ? User::find($user->refer_id)->phone : trans('compact.user.datatable.ref');
				return '<span class="label label-purple">'.$ref.'</span>';

			})->editColumn('phone', function ($user) {
				return $user->phone;

			})->editColumn('vStatus', function ($user) {
				if ($user->can_create_vcard) {
					return '<span class="label label-success">فعال</span>';
				} else {
					return '<span class="label label-danger">غیرفعال</span>';
				}
			})->addColumn('action', function ($user) {
//				$delLink = route('dashboard.category.destroy', ['user' => $user->id]);
				$delBtn = "<a href='#' class='btn btn-xs red'><i class='fa fa-trash' style='font-size: 20px;'></i></a>";

				if ($user->status == 1) {
//					$acitveLink = route('dashboard.category.deactive', ['user' => $user->id]);
					$activeBtn = "<a href='#' class='btn btn-xs success'><i class='fa fa-flag' style='font-size: 20px;'></i></a>";
				} else {
//					$acitveLink = route('dashboard.category.active', ['user' => $user->id]);
					$activeBtn = "<a href='#' class='btn btn-xs red'><i class='fa fa-flag-o' style='font-size: 20px;'></i></a>";
				}

//				$showLink = route('dashboard.category.show', ['user' => $user->id]);
				$showBtn = "<a href='#' class='btn btn-xs blue'><i class='fa fa-edit' style='font-size: 20px;'></i></a>";

				return sprintf("%s\n%s\n%s", $showBtn, $activeBtn, $delBtn);

			})->rawColumns(['image', 'ref', 'vStatus', 'action'])
			->make(true);
	}

}

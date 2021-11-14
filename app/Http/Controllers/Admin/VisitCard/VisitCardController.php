<?php

namespace App\Http\Controllers\Admin\VisitCard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VisitCard\AdminVisitCardIndexBlackRequest;
use App\Http\Requests\Admin\VisitCard\AdminVisitCardIndexRequest;
use App\Models\User\User;
use App\Models\VisitCard\VisitCard;
use Yajra\DataTables\Facades\DataTables;

class VisitCardController extends Controller
{
	/**
	 * @param AdminVisitCardIndexRequest $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(AdminVisitCardIndexRequest $request)
	{
		$title = trans('compact.vcard.index.title');
		$subTitle = trans('compact.vcard.index.subTitle');

		return view('admin.vcard.index', compact('title', 'subTitle'));
	}

	/**
	 * @param AdminVisitCardIndexBlackRequest $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function indexBlack(AdminVisitCardIndexBlackRequest $request)
	{
		$title = trans('compact.vcard.indexBlack.title');
		$subTitle = trans('compact.vcard.indexBlack.subTitle');

		return view('admin.vcard.blacklist', compact('title', 'subTitle'));
	}

	/**
	 * @param $type
	 * @return mixed
	 * @throws \Exception
	 */
	public function datatable($type)
	{
		/** @var VisitCard $query */
		$query = VisitCard::query();

		if ($type == VisitCard::TYPE_WHITE) {
			/** @var VisitCard[] $visitCards */
			$visitCards = $query->Active()->get();

		} elseif ($type == VisitCard::TYPE_BLACK) {
			/** @var VisitCard[] $visitCards */
			$visitCards = $query->NotActive()->get();

		}

		return DataTables::of($visitCards)
			->editColumn('image', function ($visitCard) {
				return '<img src="' . $visitCard->photo_url . '" height="50px"/>';

			})->editColumn('user', function ($visitCard) {
				/** @var User $user */
				$user = User::find($visitCard->user_id);

				return $user->first_name . ' ' . $user->last_name;

			})->editColumn('title', function ($visitCard) {
				return $visitCard->title;

			})->editColumn('phone', function ($visitCard) {
				return $visitCard->phone;

			})->editColumn('specialty', function ($visitCard) {
				return $visitCard->specialty;

			})->editColumn('view_count', function ($visitCard) {
				return '<span class="label label-success">' . $visitCard->view_count . '</span>';

			})->addColumn('action', function ($visitCard) {
//				$delLink = route('dashboard.category.destroy', ['user' => $visitCard->id]);
				$delBtn = "<a href='#' class='btn btn-xs red'><i class='fa fa-trash' style='font-size: 20px;'></i></a>";

				if ($visitCard->status == 1) {
//					$acitveLink = route('dashboard.category.deactive', ['user' => $visitCard->id]);
					$activeBtn = "<a href='#' class='btn btn-xs success'><i class='fa fa-flag' style='font-size: 20px;'></i></a>";
				} else {
//					$acitveLink = route('dashboard.category.active', ['user' => $visitCard->id]);
					$activeBtn = "<a href='#' class='btn btn-xs red'><i class='fa fa-flag-o' style='font-size: 20px;'></i></a>";
				}

//				$showLink = route('dashboard.category.show', ['user' => $visitCard->id]);
				$showBtn = "<a href='#' class='btn btn-xs blue'><i class='fa fa-edit' style='font-size: 20px;'></i></a>";

				return sprintf("%s\n%s\n%s", $showBtn, $activeBtn, $delBtn);

			})->rawColumns(['image', 'view_count', 'action'])
			->make(true);
	}
}

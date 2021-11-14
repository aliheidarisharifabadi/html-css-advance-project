<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Report\AdminReportIndexRequest;
use App\Models\VisitCard\Report;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
	/**
	 * @param AdminReportIndexRequest $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(AdminReportIndexRequest $request)
	{
		$title = trans('compact.report.index.title');
		$subTitle = trans('compact.report.index.subTitle');

		return view('admin.report.index', compact('title', 'subTitle'));
	}

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function datatable()
	{
		/** @var Report $query */
		$query = Report::query();

		/** @var Report[] $report */
		$reports = $query->Active()->get();

		return DataTables::of($reports)
			->editColumn('image', function ($report) {
				return '<img src="' . $report->visitCard->photo_url . '" height="50px"/>';

			})->editColumn('user', function ($report) {
				return getUserFullName($report->visitCard->user_id);

			})->editColumn('title', function ($report) {
				return $report->visitCard->title;

			})->editColumn('userR', function ($report) {
				return getUserFullName($report->user_id);

			})->editColumn('reason', function ($report) {
				return $report->reason;

			})->editColumn('anger', function ($report) {
				return '<span class="label label-danger">' . $report->anger . '</span>';

			})->editColumn('date', function ($report) {
				return '<span class="label label-info">' . $report->j_created_at . '</span>';

			})->addColumn('action', function ($report) {
//				$delLink = route('dashboard.category.destroy', ['user' => $report->id]);
				$delBtn = "<a href='#' class='btn btn-xs red'><i class='fa fa-trash' style='font-size: 20px;'></i></a>";

				if ($report->status == 1) {
//					$acitveLink = route('dashboard.category.deactive', ['user' => $report->id]);
					$activeBtn = "<a href='#' class='btn btn-xs success'><i class='fa fa-flag' style='font-size: 20px'></i></a>";
				} else {
//					$acitveLink = route('dashboard.category.active', ['user' => $report->id]);
					$activeBtn = "<a href='#' class='btn btn-xs red'><i class='fa fa-flag-o' style='font-size: 20px'></i></a>";
				}

				return sprintf("%s\n%s", $activeBtn, $delBtn);

			})->rawColumns(['image', 'anger', 'date', 'action'])
			->make(true);
	}
}

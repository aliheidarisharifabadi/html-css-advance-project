<?php

namespace App\Http\Controllers\v1\VisitCard;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Report\ReportDestroyRequest;
use App\Http\Requests\v1\Report\ReportIndexRequest;
use App\Http\Requests\v1\Report\ReportStatusRequest;
use App\Http\Requests\v1\Report\ReportStoreRequest;
use App\Http\Resources\v1\VisitCard\ReportIndexResource;
use App\Models\Counter\Counter;
use App\Models\User\User;
use App\Models\VisitCard\Report;
use Carbon\Carbon;

class ReportController extends Controller
{
	/**
	 * @param ReportIndexRequest $request
	 * @return \App\Http\Resources\ActionResource|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(ReportIndexRequest $request)
	{
		/** @var Report $query */
		$query = Report::query();

		/** @var User $user */
		$user = auth()->user();

		$role = $user->canUser('report.index');

		if ($role == User::ROLE_ADMIN) {

			$reports = $query->all();

		} else {

			return ActionResource(trans('messages.exception.not_access'), false);

		}

		return ReportIndexResource::collection($reports)->additional([
			'success' => true,
			'message' => '',
		]);
	}

	/**
	 * @param ReportStoreRequest $request
	 * @return \App\Http\Resources\ActionResource
	 */
	public function report(ReportStoreRequest $request)
	{
		/** @var User $user */
		$user = auth()->user();

		/** @var integer $counter */
		$count = Counter::where('user_id', $user->id)
			->whereBetween('updated_at', [Carbon::now()->subDays(2), Carbon::now()])
			->count();

		if ($count > Counter::LIMIT_TIME) {

			return ActionResource(trans('messages.report.reportNotPossible'), false);

		}

		Report::create([
			'user_id'       => $user->id,
			'visit_card_id' => $request->vcard_id,
			'reason'        => $request->reason,
			'anger'         => $request->anger,
			'status'        => false,
		]);

		return ActionResource(trans('messages.report.reported'), true);
	}

	/**
	 * @param ReportStatusRequest $request
	 * @param Report              $report
	 * @return \App\Http\Resources\ActionResource
	 */
	public function status(ReportStatusRequest $request, Report $report)
	{
		if ($report->status == $request->status) {

			return ActionResource(trans('messages.report.invalidStatus'), false);

		}

		$report->status = $request->status;
		$report->save();

		if ($report->status == true) {

			/** @var Counter $counter */
			$counter = Counter::whereBetween([
				'user_id'       => $report->user_id,
				'visit_card_id' => $report->visit_card_id,
			])->first();

			if ($counter) {

				$counter->report_count++;
				$counter->save();

			} else {

				Counter::create([
					'user_id'       => $report->user_id,
					'visit_card_id' => $report->visit_card_id,
				]);

			}

		}

		return ActionResource(trans('messages.report.updatedStatus'), true);
	}

	/**
	 * @param ReportDestroyRequest $request
	 * @param Report               $report
	 * @return \App\Http\Resources\ActionResource
	 * @throws \Exception
	 */
	public function destroy(ReportDestroyRequest $request, Report $report)
	{
		$report->delete();

		return ActionResource(trans('messages.report.deleted'), true);
	}

}

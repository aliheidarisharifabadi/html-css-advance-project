<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Requests\Admin\Dashboard\DashboardIndexRequest;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	/**
	 * @param DashboardIndexRequest $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(DashboardIndexRequest $request)
    {
    	/** update all counter cin dashboard */
    	updateAllCount();

		$subTitle = trans('compact.dashboard.subTitle');

		return view('admin.dashboard.index', compact('subTitle'));
    }
}

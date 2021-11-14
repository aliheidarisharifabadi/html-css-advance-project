<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Requests\Web\Home\HomeIndexRequest;
use App\Http\Controllers\Controller;
use App\Models\User\User;

class HomeController extends Controller
{
	public function index(HomeIndexRequest $request)
	{
		/** @var User $user */
		$user = auth()->user();

		if ($user->hasRole(User::ROLE_ADMIN)){
			// Admin Operation
			return redirect()->route('dashboard.index');

		}else if($user->hasRole(User::ROLE_USER)){
			// User Operation

		}

		return redirect()->back();
    }
}

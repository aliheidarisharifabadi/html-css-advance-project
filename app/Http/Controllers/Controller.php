<?php

namespace App\Http\Controllers;

use App\Models\Notification\Notification;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/**
	 * @param int    $user_id
	 * @param array  $inputData
	 * @param string $role
	 */
	public function sendNotification(int $user_id, string $role, array $inputData)
	{
		Notification::fireToUserDevices($user_id, $role, $inputData);

		// @todo Logger code here ...

    }

}

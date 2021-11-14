<?php

use App\Models\User\User;

function getUserFullName(int $id = NULL)
{
	if ($id) {

		/** @var User $user */
		$user = User::find($id);
		return $user->first_name . ' ' . $user->last_name;

	} else {

		return auth()->user()->first_name . ' ' . auth()->user()->last_name;

	}
}


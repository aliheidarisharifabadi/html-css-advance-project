<?php

use App\Models\Notification\Notification;
use App\Models\User\User;
use App\Models\VisitCard\Report;
use App\Models\VisitCard\VisitCard;

function updateAllCount()
{
	session(['whiteUsersCount' => User::Active()->count()]);
	session(['blackUsersCount' => User::NotActive()->count()]);

	session(['whiteVcardsCount' => VisitCard::Active()->count()]);
	session(['blackVcardsCount' => VisitCard::NotActive()->count()]);

	session(['activeReportsCount' => Report::Active()->count()]);
	session(['notActiveReportsCount' => Report::NotActive()->count()]);

	session(['activeNotificationCount' => Notification::Active()->count()]);

}


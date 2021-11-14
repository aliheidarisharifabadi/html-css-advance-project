<?php

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::namespace('Dashboard')
        ->group(base_path('routes/admin/dashboard.php'));

    Route::namespace('User')
        ->group(base_path('routes/admin/user.php'));

    Route::namespace('VisitCard')
        ->group(base_path('routes/admin/vcard.php'));

    Route::namespace('Report')
        ->group(base_path('routes/admin/report.php'));

    Route::namespace('Notification')
        ->group(base_path('routes/admin/notification.php'));

});

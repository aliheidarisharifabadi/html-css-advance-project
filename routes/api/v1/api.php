<?php

Route::prefix('auth')
	->namespace('User')
	->group(base_path('routes/api/v1/auth.php'));

Route::namespace('Dashboard')
	->group(base_path('routes/api/v1/dashboard.php'));

Route::group(['middleware' => 'auth:api'], function () {

	Route::namespace('User')
		->group(base_path('routes/api/v1/user.php'));

	Route::namespace('User')
		->group(base_path('routes/api/v1/social.php'));

	Route::namespace('User')
		->group(base_path('routes/api/v1/favorite.php'));

	Route::namespace('Location')
		->group(base_path('routes/api/v1/location.php'));

	Route::namespace('Notification')
		->group(base_path('routes/api/v1/notification.php'));

	Route::namespace('VisitCard')
		->group(base_path('routes/api/v1/visitCard.php'));

	Route::namespace('VisitCard')
		->group(base_path('routes/api/v1/report.php'));

});

Route::namespace('Common')
	->group(base_path('routes/api/v1/common.php'));

Route::get('state', 'Location\StateController@index')->name('state.index.no-auth');
Route::get('cities/{state}', 'Location\StateController@cities')->name('state.cities');



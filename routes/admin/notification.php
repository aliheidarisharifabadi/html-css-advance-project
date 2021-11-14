<?php

Route::group(['prefix' => 'notification','as' => 'notification.'], function () {

	// notification routes
    Route::get('/', 'NotificationController@index')->name('index');

	Route::get('/datatable', 'NotificationController@datatable')->name('datatable');

    Route::post('/', 'NotificationController@store')->name('store');

	Route::get('/show/{notification}', 'NotificationController@show')->name('show');

	Route::get('/status/{notification}', 'NotificationController@status')->name('status');
	// end routes

	// notifItem routes
    Route::get('/key', 'NotificationController@key')->name('key');

	Route::get('/key/datatable', 'NotificationController@keyDatatable')->name('key.datatable');

    Route::post('/key', 'NotificationController@keyStore')->name('key.store');

    Route::get('/key/status/{item}', 'NotificationController@keyStatus')->name('key.status');
	// end routes
});

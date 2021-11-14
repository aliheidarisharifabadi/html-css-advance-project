<?php

Route::resource('notification', 'NotificationController')->except([

]);

Route::group(['prefix' => 'notification', 'as' => 'notification.'], function () {

	Route::post('deliver', 'NotificationController@deliver')->name('deliver');

	Route::post('click', 'NotificationController@click')->name('click');

});

<?php

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {

	Route::get('/', 'DashboardController@index')->name('index');

	Route::get('/{card}', 'DashboardController@show')->name('show');

	Route::post('/search', 'DashboardController@search')->name('search');

});


<?php

Route::group(['prefix' => 'dashboard','as' => 'dashboard.'], function () {

    Route::get('/', 'DashboardController@index')->name('index');

});

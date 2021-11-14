<?php

Route::group(['prefix' => 'report', 'as' => 'report.'], function () {

	Route::get('/', 'ReportController@index')->name('index');

	Route::post('/', 'ReportController@report')->name('report');

	Route::post('/{report}/status', 'ReportController@status')->name('status');

	Route::delete('/{report}', 'ReportController@destroy')->name('destroy');

});


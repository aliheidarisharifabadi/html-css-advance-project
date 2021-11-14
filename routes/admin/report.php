<?php

Route::group(['prefix' => 'report','as' => 'report.'], function () {

    Route::get('/', 'ReportController@index')->name('index');

    Route::get('/datatable', 'ReportController@datatable')->name('datatable');

});

<?php

Route::group(['prefix' => 'vcard','as' => 'vcard.'], function () {

    Route::get('/', 'VisitCardController@index')->name('index');

    Route::get('/black', 'VisitCardController@indexBlack')->name('index.black');

    Route::get('/datatable/{type}', 'VisitCardController@datatable')->name('datatable');

});

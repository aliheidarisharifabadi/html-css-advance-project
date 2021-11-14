<?php

Route::group(['prefix' => 'user','as' => 'user.'], function () {

    Route::get('/', 'UserController@index')->name('index');

    Route::get('/black', 'UserController@indexBlack')->name('index.black');

    Route::get('/datatable/{type}', 'UserController@datatable')->name('datatable');

});

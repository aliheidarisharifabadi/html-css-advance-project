<?php

Route::group(['prefix' => 'home','as' => 'home.'], function () {

	Route::get('/', 'HomeController@index')->name('index');

});
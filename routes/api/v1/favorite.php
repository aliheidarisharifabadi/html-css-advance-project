<?php

Route::group(['prefix' => 'favorite', 'as' => 'favorite.'], function () {

	Route::get('/', 'FavoriteController@index')->name('index');

	Route::post('/', 'FavoriteController@store')->name('store');

	Route::delete('/{favorite}', 'FavoriteController@destroy')->name('destroy');

});


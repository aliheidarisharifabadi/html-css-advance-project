<?php

//Route::resource('category', 'CategoryController')->except([
//    'destroy', 'create',
//]);

Route::get('category', 'CategoryController@index')->name('category.index');

Route::get('category/{category}/vcard', 'CategoryController@getVisitCards')->name('category.getVisitCards');
Route::get('category/{category}/children', 'CategoryController@children')->name('category.children');
Route::get('category/parent', 'CategoryController@parents')->name('category.parent');




Route::group(['middleware' => 'auth:api'], function () {

	Route::post('category', 'CategoryController@store')->name('category.store');
	Route::get('category/{category}', 'CategoryController@show')->name('category.show');
	Route::patch('category/{category}', 'CategoryController@update')->name('category.update');

	Route::apiResource('photo', 'PhotoController')->only([
		'store', 'update',
	]);

	Route::post('photo/avatar', 'PhotoController@storeAvatar')->name('photo.avatar');

	Route::resource('option', 'OptionController')->except([
		'create', 'destroy',
	]);

});

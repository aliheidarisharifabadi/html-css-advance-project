<?php

Route::resource('/user', 'UserController')->except([
	'destroy','index'
]);

Route::post('/user', 'UserController@index')->name('user.index');




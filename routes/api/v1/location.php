<?php

Route::apiResource('state', 'StateController')->except([
	'index', 'destroy',
]);

Route::get('state/tree/view', 'StateController@tree')->name('state.tree');

Route::apiResource('city', 'CityController')->except([
	'index', 'destroy'
]);



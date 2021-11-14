<?php

Route::resource('/social', 'SocialController')->except([
	'create'
]);

Route::post('/social/{social}/status', 'SocialController@status')->name('social.status');




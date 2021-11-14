<?php

Route::group(['as' => 'api.'], function () {

	Route::post('/code/request', 'AuthController@verifyCodeRequest')->name('code.request');

	Route::post('/voice/request', 'AuthController@voiceRequest')->name('voice.request');

	Route::post('/code/validate', 'AuthController@verifyCodeValidate')->name('code.validate');

	Route::post('/register', 'AuthController@register')->name('register');

	Route::post('/refresh', 'AuthController@refresh')->name('refresh.validate');

	Route::post('/version', 'AuthController@version')->name('version');

	Route::group(['middleware' => 'auth:api'], function () {

		Route::post('/validate/token', 'AuthController@validateAccessToken')->name('access.validate');

		Route::post('/logout', 'AuthController@logout')->name('logout');

		Route::post('/firebase', 'AuthController@updateFireBaseTokenWithAuth')->name('firebase.auth');

	});

	Route::post('/firebase/non', 'AuthController@updateFireBaseTokenWithOutAuth')->name('firebase.nonAuth');

});



<?php

Route::resource('/vcard', 'VisitCardController');

Route::post('/vcard/{vcard}/status', 'VisitCardController@status')->name('vcard.status');
Route::post('/vcard/{vcard}/view', 'VisitCardController@viewCount')->name('vcard.viewCount');
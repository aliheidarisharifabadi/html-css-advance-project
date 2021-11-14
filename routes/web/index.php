<?php

Route::view('/', 'welcome')->name('welcome');

Route::namespace('Home')
	->middleware(['auth', 'role:admin|user'])
	->group(base_path('routes/web/home.php'));

Route::get('/token/{id}/{role}', function (\Illuminate\Http\Request $request, $id, $role) {

	$user = \App\Models\User\User::find($id ?? 1);

	if (app()->environment() == 'local') {
		return setTypeToAccessToken($role, $user->createToken('Test')->accessToken);
	}

	return '😁';
});
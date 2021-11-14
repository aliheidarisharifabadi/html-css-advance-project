<?php

Route::namespace('Web')
	->group(base_path('routes/web/index.php'));

Route::namespace('Auth')
	->group(base_path('routes/web/auth.php'));

Route::namespace('Admin')
	->group(base_path('routes/admin/index.php'));


<?php

namespace App\Providers;

use App\Models\User\Voice;
use App\Models\User\SMS;
use App\Observers\v1\Common\SMSObserver;
use App\Observers\v1\Common\VoiceObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Schema::defaultStringLength(191);

		/** observe Product model for getting log and save in product_logs table */
		SMS::observe(SMSObserver::class);
		Voice::observe(VoiceObserver::class);

	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}

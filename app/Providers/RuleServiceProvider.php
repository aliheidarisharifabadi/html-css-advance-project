<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class RuleServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public static function boot()
	{
		Validator::extend('deny', function () {
			return false;
		});

		Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {

			if (!is_string($value)) {
				return false;
			}

			return preg_match('/^09\d{9}$/', $value);
		});

		Validator::extend('national_code', function ($attribute, $value, $parameters, $validator) {

			if (!is_string($value)) {
				return false;
			}

			if (!preg_match('/^[0-9]{10}$/', $value)) {
				return false;
			}

			for ($i = 0; $i < 10; $i++) {
				if (preg_match('/^' . $i . '{10}$/', $value)) {
					return false;
				}
			}

			for ($i = 0, $sum = 0; $i < 9; $i++) {
				$sum += ((10 - $i) * intval(substr($value, $i, 1)));
			}

			$ret = $sum % 11;
			$parity = intval(substr($value, 9, 1));

			if (($ret < 2 && $ret == $parity) || ($ret >= 2 && $ret == 11 - $parity)) {
				return true;
			}

			return false;
		});

		Validator::extend('not_exists', function ($attribute, $value, $parameters) {
			return \DB::table($parameters[0])
					->where($parameters[1], '=', $value)
					->count() < 1;
		});

		Validator::extend('gt', function ($attribute, $value, $parameters, $validator) {
			$min_field = $parameters[0];
			$data = $validator->getData();
			return $value > $data[$min_field];
		});

		Validator::replacer('gt', function ($message, $attribute, $rule, $parameters) {
			$attr = '';

			if (\Lang::has('validation.attributes.' . $parameters[0])) {
				$attr = trans('validation.attributes.' . $parameters[0]);
			}

			return str_replace(':attr', $attr, $message);
		});

		Validator::extend('gte', function ($attribute, $value, $parameters, $validator) {
			$min_field = $parameters[0];
			$data = $validator->getData();
			return $value >= $data[$min_field];
		});

		Validator::replacer('gte', function ($message, $attribute, $rule, $parameters) {
			$attr = '';

			if (\Lang::has('validation.attributes.' . $parameters[0])) {
				$attr = trans('validation.attributes.' . $parameters[0]);
			}

			return str_replace(':attr', $attr, $message);
		});
	}

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}

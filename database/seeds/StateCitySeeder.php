<?php

use App\Models\Group\Group;
use App\Models\Provider\Provider;
use App\Models\User\Role;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StateCitySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(\Faker\Generator $faker)
	{
		DB::table('cities')->truncate();
		DB::table('states')->truncate();

		$json = File::get(public_path('dbSeed/states.json'));
		$data = json_decode($json, true);

		foreach ($data['states'] as $state) {

			DB::table("states")->insert([
				'id'   => $state['id'],
				'name' => $state['name'],
			]);

		}

		$json = File::get(public_path('dbSeed/cities.json'));
		$data = json_decode($json, true);

		foreach ($data['cities'] as $city) {

			DB::table("cities")->insert([
				'id'       => $city['id'],
				'name'     => $city['name'],
				'state_id' => $city['state_id'],
			]);

		}
	}
}

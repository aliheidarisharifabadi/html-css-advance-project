<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PhotoSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @param \Faker\Generator $faker
	 * @return void
	 */
	public function run(\Faker\Generator $faker)
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('photos')->truncate();

		$json = File::get(public_path('dbSeed/photos.json'));
		$data = json_decode($json, true);
		$array1 = $data;

		foreach ($array1['photos'] as $photo) {

			DB::table("photos")->insert(
				[
					'id'        => $photo['id'],
					'user_id'   => NULL,
					'path'      => $photo['path'],
					'thumbnail' => $photo['thumbnail'],
					'disk'      => $photo['disk'],
					'ext'       => $photo['ext'],
				]);

		}

	}
}

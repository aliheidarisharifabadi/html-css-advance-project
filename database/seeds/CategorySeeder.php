<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Faker\Generator;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @param \Faker\Generator $faker
	 * @return void
	 */
	public function run(Generator $faker)
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('categories')->truncate();

		$json = File::get(public_path('dbSeed/categories.json'));
		$data = json_decode($json, true);
		$array1 = $data;

		foreach ($array1['categories'] as $obj) {

			DB::table('categories')->insert([
				'id'          => $obj['id'],
				'name'        => $obj['name'],
				'description' => $obj['description'],
				'slug'        => $obj['slug'],
				'selected'    => $obj['selected'],
				'_lft'        => $obj['_lft'],
				'_rgt'        => $obj['_rgt'],
				'parent_id'   => $obj['parent_id'],
			]);
		}

	}
}

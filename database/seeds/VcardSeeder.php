<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Faker\Generator;

class VcardSeeder extends Seeder
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
		DB::table('visit_card_categories')->truncate();
		DB::table('visit_card_zone')->truncate();
		DB::table('zones')->truncate();
		DB::table('visit_card_social')->truncate();
		DB::table('visit_cards')->truncate();
		DB::table('favorites')->truncate();
		DB::table('reports')->truncate();
		DB::table('socials')->truncate();

		$json = File::get(public_path('dbSeed/vcards.json'));
		$data = json_decode($json, true);
		$array1 = $data;

		$flag = false;

		for ($i = 1; $i <= 5; $i++) {
			\App\Models\User\Social::create([
				'user_id' => 1,
				'type'    => 'phone',
				'name'    => 'تلفن',
				'value'   => '03131313131',
				'status'  => true,
			]);
		}

		foreach ($array1['vcards'] as $obj) {

			DB::table('zones')->insert([
				'id'       => $obj['id'],
				'user_id'  => 1,
				'state_id' => mt_rand(1, 30),
				'city_id'  => mt_rand(10, 500),
				'address'  => $obj['specialty'],
				'status'   => $obj['status'],
			]);

			DB::table('visit_cards')->insert([
				'id'          => $obj['id'],
				'user_id'     => 1,
				'title'       => $obj['title'],
				'specialty'   => $obj['specialty'],
				'description' => $obj['description'],
				'status'      => $obj['status'],
			]);

			DB::table('visit_card_social')->insert([
				'visit_card_id' => $obj['id'],
				'social_id'     => 1,
			]);

			DB::table('visit_card_social')->insert([
				'visit_card_id' => $obj['id'],
				'social_id'     => 2,
			]);

			DB::table('visit_card_zone')->insert([
				'visit_card_id' => $obj['id'],
				'zone_id'       => $obj['id'],
			]);

			for ($i = 1; $i <= 5; $i++) {
				DB::table('visit_card_categories')->insert([
					'visit_card_id' => $obj['id'],
					'category_id'   => $i,
				]);
			}

			if ($flag) {
				DB::table('favorites')->insert([
					'user_id'       => 1,
					'visit_card_id' => $obj['id'],
					'status'        => $obj['status'],
				]);
			} else {
				DB::table('reports')->insert([
					'user_id'       => 1,
					'visit_card_id' => $obj['id'],
					'reason'        => 'این یک متن تست گزارش است',
					'anger'         => mt_rand(1, 9),
					'status'        => $obj['status'],
				]);
			}

			$flag = !$flag;

		}

	}
}

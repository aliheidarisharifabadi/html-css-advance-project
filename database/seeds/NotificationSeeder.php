<?php

use App\Models\Common\Option;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('notification_item')->truncate();
		DB::table('notif_items')->truncate();
		DB::table('notifications')->truncate();

		$id = 1;

		for ($i = 1; $i < 11; $i++) {

			DB::table('notif_items')->insert([
				'id'     => $i,
				'type'   => 'news',
				'key'    => 'کلید ' . $i,
				'status' => true,
			]);

			for ($j = 1; $j < 5; $j++) {

				DB::table('notifications')->insert([
					'id'            => $id ,
					'type'          => 'news',
					'click_count'   => mt_rand(10, 200),
					'deliver_count' => mt_rand(10, 500),
					'status'        => true,
				]);

				DB::table('notification_item')->insert([
					'id'              => $id,
					'notification_id' => $id,
					'item_id'         => $i,
					'value'           => 'مقدار تست ' . $j,
				]);

				$id++;
			}

		}
	}

}

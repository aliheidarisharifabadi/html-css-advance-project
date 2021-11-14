<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table("users")->insert([
			'phone'            => '09379675606',
			'first_name'       => 'حمید',
			'last_name'        => 'سیناپور',
			'status'           => true,
			'can_create_vcard' => true,
			'password'         => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
		]);

		$this->call(RolePermissionSeeder::class);
		DB::table("role_user")->insert([
			'user_id' => 1,
			'role_id' => 1,
		]);
		DB::table("role_user")->insert([
			'user_id' => 1,
			'role_id' => 2,
		]);
		$this->call(CategorySeeder::class);
		$this->call(StateCitySeeder::class);
		$this->call(OptionSeeder::class);
		$this->call(VcardSeeder::class);
		$this->call(NotificationSeeder::class);
	}
}

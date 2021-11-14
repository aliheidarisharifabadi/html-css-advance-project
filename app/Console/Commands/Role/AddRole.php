<?php

namespace App\Console\Commands\Role;

use App\Models\User\Role;
use Illuminate\Console\Command;

class AddRole extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'role:add {role : Role name} {--N|name= : Display name} {--vendor= : Vendor ID}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add new role';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$role = $this->argument('role');

		$vendor = $this->option('vendor');

		if (Role::Name($role)->VendorID($vendor)->count()) {
			$this->warn('Role exists!');
			return false;
		}

		$name = $this->option('name');

		if (is_null($name)) {
			$name = $role;
		}

		Role::create([
			'name'         => $role,
			'display_name' => $name,
			'vendor_id'    => $vendor,
		]);

		$this->info("Role created!");
	}
}

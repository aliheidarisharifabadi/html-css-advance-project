<?php

namespace App\Console\Commands\Role;

use App\Models\User\Role;
use Illuminate\Console\Command;

class DelRole extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'role:del {role : Role name} {--vendor= : Vendor ID}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Remove Role';

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

		/** @var Role $role */
		$role = Role::Name($role)->VendorID($vendor)->first();

		if (is_null($role)) {
			$this->warn('Role not exists!');
			return false;
		}

		if($role->Users()->count()){
			$this->warn('Role is not empty!');
			return false;
		}

		if ($this->confirm('Do you wish to delete?')) {

			$role->delete();

			$this->info('Role deleted!');
		}
	}
}

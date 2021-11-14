<?php

namespace App\Console\Commands\Role;

use App\Console\Commands\Permission\AddPermission;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Console\Command;

class detachPermission extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'role:detach {role : Role name} {permissions* : List of permissions name} {--C|complete : Add crud in permission} {--S|super : Add super permissions}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'detach permissions from role';

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

		/** @var Role $role */
		$role = Role::Name($role)->first();

		if (is_null($role)) {
			$this->warn('Role not exists!');
			return false;
		}

		$permissions = [];

		$complete = $this->option('complete');
		$super = $this->option('super');

		foreach ($this->argument('permissions') as $permission) {
			$permissions[] = AddPermission::generate($permission, $complete, $super);
		}

		$role->detachPermissions(array_flatten($permissions));

		$this->info('Permissions detached.');

		return true;
	}
}

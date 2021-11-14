<?php

namespace App\Console\Commands\Permission;

use App\Models\User\Permission;
use Illuminate\Console\Command;

class PermissionList extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'permission:list';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'List of permissions';

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
		$headers = ['id', 'name'];

		$roles = Permission::select($headers)
			->with('Roles')
			->get();

		$roles = $roles->map(function ($role) {
			$roles = $role->roles->pluck('name')->implode(',');

			$role = $role->toArray();
			$role['roles'] = $roles;

			return $role;
		})->toArray();

		$headers[] = 'roles';

		$this->table($headers, $roles);
	}
}

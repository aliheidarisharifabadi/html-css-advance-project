<?php

namespace App\Console\Commands\Permission;

use App\Models\User\Permission;
use Illuminate\Console\Command;

class DelPermission extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'permission:del {permission : Permission name} {--C|complete : Add crud in permission} {--S|super : Add super permissions}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Delete a permission';

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
	 * @throws \Exception
	 */
	public function handle()
	{
		$permission = $this->argument('permission');

		$permissions = AddPermission::generate($permission, $this->option('complete'), $this->option('super'));

		/** @var Permission[] $permission */
		$permissions = Permission::Name($permissions)->with('Roles')->get();

		if (is_null($permissions)) {
			$this->warn('Permission(s) not exists!');
			return false;
		}

		if ($permissions->pluck('Roles')->filter('count')->count()) {
			$this->warn('Permission(s) is not empty!');
			return false;
		}

		if ($this->confirm('Do you wish to delete?')) {

			$permissions->map(function ($permission){
				$permission->delete();
			});

			$this->info('Permission deleted!');
		}

		return true;
	}
}

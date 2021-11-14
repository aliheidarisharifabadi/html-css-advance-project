<?php

namespace App\Console\Commands\Permission;

use App\Models\User\Permission;
use Illuminate\Console\Command;

class AddPermission extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'permission:add {permission : Permission name} {--C|complete : Add crud in permission} {--S|super : Add super permissions}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add a permission';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public static function generate($permission, $complete = false, $super = false)
	{
		$permissions = [];

		if ($complete) {
			$permissions = [
				$permission . '.index',
				$permission . '.show',
				$permission . '.store',
				$permission . '.update',
				$permission . '.destroy',
			];
		}

		if ($super) {

			if (count($permissions)) {
				$permissions[] = $permission . '.index.super';
				$permissions[] = $permission . '.show.super';
				$permissions[] = $permission . '.store.super';
				$permissions[] = $permission . '.update.super';
				$permissions[] = $permission . '.destroy.super';
			} else {
				$permissions = [
					$permission,
					$permission . '.super',
				];
			}

		}

		if (!count($permissions)) {
			$permissions = [$permission];
		}

		return $permissions;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$permission = $this->argument('permission');

		$permissions = self::generate($permission, $this->option('complete'), $this->option('super'));

		if (Permission::Name($permissions)->count()) {
			$this->warn('Permission exists!');
			return false;
		}

		sort($permissions);

		foreach ($permissions as $permission) {
			Permission::create([
				'name' => $permission,
			]);
		}

		$this->info("Permission(s) created!");
		return true;
	}
}

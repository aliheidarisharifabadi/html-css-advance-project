<?php

namespace App\Console\Commands\Role;

use App\Models\User\Role;
use Illuminate\Console\Command;

class RoleList extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'role:list';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'List of Roles';

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
		$headers = ['id', 'name', 'vendor_id'];

		$roles = Role::select($headers)
			->withCount('Users')
			->get()
			->toArray();

		$headers[] = 'users_count';

		$this->table($headers, $roles);
	}
}

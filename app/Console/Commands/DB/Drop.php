<?php

namespace App\Console\Commands\DB;

use DB;
use Illuminate\Console\Command;
use Illuminate\Database\Migrations\Migration;
use Schema;

class Drop extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'migrate:drop {table}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Drop a table';

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
		$table = $this->argument('table');

		if ($this->confirm('Do you wish to drop table?')) {

			if(!Schema::hasTable($table)){
				return $this->warn('Table not found!');
				return false;
			}

			$count = DB::table($table)->count();

			if ($this->confirm("Do you wish to delete {$count} row?")) {

				DB::table('migrations')
					->where('migration', 'LIKE', "%create_{$table}_table%")
					->delete();

				Schema::dropIfExists($table);
				return true;
			}
		}

		return false;
	}

}

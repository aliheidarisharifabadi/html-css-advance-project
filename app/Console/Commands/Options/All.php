<?php

namespace App\Console\Commands\Options;

use App\Models\Common\Option;
use Illuminate\Console\Command;

class All extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'option:list';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'List of options';

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
		$headers = ['name', 'key'];

		$this->table($headers, Option::all());
	}
}

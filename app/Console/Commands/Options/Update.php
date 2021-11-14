<?php

namespace App\Console\Commands\Options;

use App\Models\Common\Option;
use Illuminate\Console\Command;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'option:update {name : Name of option} {value : New Value}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update option value';

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
		$name = $this->argument('name');
		$value = $this->argument('value');

		Option::up($name, $value);

		$this->info('Option was updated.');
		return true;
    }
}

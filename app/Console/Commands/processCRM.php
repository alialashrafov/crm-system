<?php

namespace App\Console\Commands;

use App\Http\Controllers\CRM\SystemLogsController;
use App\Services\SystemLogService;
use Illuminate\Console\Command;
use Request;

class processCRM extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process-crm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all missing process to start using CRM';

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
        $this->info('Welcome in CRM System!');

        $this->info('===============================================================');
        $this->info('[Let\'s start process all migrations:]');
        $this->call('migrate');

        $this->info('===============================================================');
        $this->info('[Let\'s start process all seeders:]');
        $this->call('db:seed');

        $this->info('===============================================================');
        $this->info('[Let\'s start process generating unique key:]');
        $this->call('key:generate');

        $this->info('===============================================================');
        $this->info('Everything looks perfect! Now you can start use CRM System!');
        $this->info('If you have any question please contact with me by email: alashrafovali@gmail.com');

        $systemLogs = new SystemLogService();
        $systemLogs->loadInsertSystemLogs('First usage of process-crm command', 200, 1);
    }
}

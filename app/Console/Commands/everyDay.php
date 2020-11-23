<?php

namespace App\Console\Commands;

use App\Services\CommandService;
use Illuminate\Console\Command;

class everyDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'diary:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create diary tasks';

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
     * @return int
     */
    public function handle()
    {
        $service = New CommandService();
        $service->diaryTasks();
    }
}

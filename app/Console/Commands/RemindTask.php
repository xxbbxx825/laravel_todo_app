<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Task;
use App\Jobs\MailOverDueTask;
use App\Jobs\MailNearDueTask;

class RemindTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send remind by email';

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
        $overDueTasks = Task::getOverDueTask();
        $nearDueTasks = Task::getNearDueTask();
        // var_dump($overDueTasks);
        if (isset($overDueTasks)) {
            foreach ($overDueTasks as $overDueTask) {
                MailOverDueTask::dispatch($overDueTask);
            }
        }
        if (isset($nearDueTasks)) {
            foreach ($nearDueTasks as $nearDueTask) {
                MailNearDueTask::dispatch($nearDueTask);
            }
        }
    }
}

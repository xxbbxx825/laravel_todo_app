<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendOverDueTaskRemind;

class MailOverDueTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $overDueTask;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($overDueTask)
    {
        $this->overDueTask = $overDueTask;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $overDueTask = $this->overDueTask;
        Mail::to($this->overDueTask['email'])->send(new SendOverDueTaskRemind($overDueTask));
    }
}

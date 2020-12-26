<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendNearDueTaskRemind;

class MailNearDueTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $nearDueTask;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($nearDueTask)
    {
        $this->nearDueTask = $nearDueTask;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $nearDueTask = $this->nearDueTask;
        Mail::to($this->nearDueTask['email'])->send(new SendNearDueTaskRemind($nearDueTask));
    }
}

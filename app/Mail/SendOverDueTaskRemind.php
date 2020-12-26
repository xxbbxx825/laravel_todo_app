<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOverDueTaskRemind extends Mailable
{
    use Queueable, SerializesModels;
    protected $overDueTask;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($overDueTask)
    {
        $this->overDueTask = $overDueTask;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.send_task_remind')
                    ->from('example@example.com')
                    ->with([
                        'overDueTask' => $this->overDueTask
                    ]);
    }
}

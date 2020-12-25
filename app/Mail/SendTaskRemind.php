<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Carbon\Carbon;
use App\Models\Task;

class SendTaskRemind extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $today = strtotime(new Carbon('today'));
        $tomorrow = strtotime(new Carbon('tomorrow'));
        $deadLine = strtotime($this->task->due);
        if ($deadLine - $today < 0) {
            $overDueTask = $this->task;
            return $this->view('email.send_task_remind')
                        ->from('example@example.com')
                        ->with([
                            'overDueTask' => $overDueTask
                        ]);
        }
        elseif ($tomorrow - $deadLine < 24*60*60) {
        $nearDueTask = $this->task;
        return $this->view('email.send_task_remind')
                    ->from('example@example.com')
                    ->with([
                        'nearDueTask' => $nearDueTask
                    ]);
        }
    }
}

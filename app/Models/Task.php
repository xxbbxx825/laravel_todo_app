<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */

    protected $fillable = [
        'user_id',
        'title',
        'status',
        'due',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function subTasks()
    {
        return $this->hasMany('App\Models\SubTask', 'task_id', 'id');
    }

    public static function getOverDueTask () {
        $tasks = Task::all();
        $today = strtotime(new Carbon('today'));
        $overDueTask = [];
        foreach ($tasks as $task) {
            $deadLine = strtotime($task->due);
            if ($deadLine - $today < 0 && $task->status === 0) {
                $overDueTask[$task->id]['title'] = $task->title;
                $overDueTask[$task->id]['status'] = $task->status;
                $overDueTask[$task->id]['due'] = $task->due;
                $overDueTask[$task->id]['email'] = $task->user->email;
            }
        }
        return $overDueTask;
    }

    public static function getNearDueTask () {
        $tasks = Task::all();
        $tomorrow = strtotime(new Carbon('tomorrow'));
        $nearDueTask = [];
        foreach ($tasks as $task) {
            $deadLine = strtotime($task->due);
            if ($tomorrow - $deadLine < 24*60*60 && $task->status === 0) {
                $nearDueTask[$task->id]['title'] = $task->title;
                $nearDueTask[$task->id]['status'] = $task->status;
                $nearDueTask[$task->id]['due'] = $task->due;
                $nearDueTask[$task->id]['email'] = $task->user->email;
            }
        }
        return $nearDueTask;
    }

    public static function getSubTasks (Task $task) {
        $subTasks = $task->sub_tasks;
        return $subTasks;
    }
}

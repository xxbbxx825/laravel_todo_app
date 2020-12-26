<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Carbon\Carbon;

class Task extends Model implements JWTSubject
{
    use HasFactory;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */

    public function user()
    {
        return $this->belongsTo('App\Models\User');
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

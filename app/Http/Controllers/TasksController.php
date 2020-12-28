<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Task;
use App\Jobs\UpdateTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct(){
        $this->middleware('jwt.auth')->only('index','store','update', 'destroy');
        $this->middleware('can:update,task')->only('update');
        $this->middleware('can:delete,task')->only('destroy');
    }

    public function indexAll()
    {
        $tasks = Task::all();
        return $tasks;
    }

    public function index (){
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->get();
        return $tasks;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->status = $request->status;

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'task not found',
            ], 404);
        } else {
            $task->user_id = Auth::id();
            $task->save();
            return $task;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Task $task)
    {
        $task->title = $request->title;
        $task->status = $request->status;

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'status' => 'required',
        ]);

        if ($task->status == 1) {
            UpdateTask::dispatch($task);
        }

        if ($validator->fails()) {
            return response()->json([
                'message' => 'task not found',
            ], 404);
        } else {
            $task->save();
            return $task;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully',
        ], 200);
    }
}

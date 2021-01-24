<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Task;
use App\Models\SubTask;
use App\Jobs\UpdateTask;
use App\Http\Requests\TasksRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function __construct(){
        $this->middleware('can:show,task')->only('view');
        $this->middleware('can:update,task')->only('update');
        $this->middleware('can:delete,task')->only('destroy');
    }

    public function index (){
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->get();
        return $tasks;
    }

    public function show(Task $task) {
        $task = Task::where('id', $task->id)->first();
        return $task;
    }

    public function store(TasksRequest $request)
    {
        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'status' => $request->status,
            'due' => $request->due,
        ]);

        return $task;

    }

    public function update(TasksRequest $request,Task $task)
    {
        $task->fill($request->all())->save();

        if ($task->status == 1) {
            UpdateTask::dispatch($task);
        }

        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if($task->delete()) {
            return response()->json(true);
        } else {
            return response()->json(false, 500);
        }
    }
}

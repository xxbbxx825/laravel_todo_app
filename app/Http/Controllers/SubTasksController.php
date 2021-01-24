<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Task;
use App\Models\SubTask;
use App\Http\Requests\SubTasksRequest;
use Illuminate\Http\Request;

class SubTasksController extends Controller
{
    public function index(Task $task) {
        $subTasks = SubTask::where('task_id', $task->id)->get();
        return $subTasks;
    }

    public function show(SubTask $subTask) {
        $subTask = SubTask::where('id', $subTask->id)->first();
        return $subTask;
    }

    public function store(SubTasksRequest $request)
    {
        $subTask = SubTask::create([
            'task_id' => $request->task_id,
            'title' => $request->title,
            'status' => $request->status,
            'due' => $request->due,
        ]);

        return $subTask;
    }

    public function update(SubTasksRequest $request, SubTask $subTask)
    {
        $subTask->fill($request->all())->save();
        return $subTask;
    }

    public function destroy(SubTask $subTask)
    {
        $subTask->delete();
        return response()->json([
            'message' => 'sub_task deleted successfully',
        ], 200);
    }
}

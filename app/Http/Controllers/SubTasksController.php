<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\SubTask;
use Validator;

class SubTasksController extends Controller
{
    public function __construct(){
        $this->middleware('jwt.auth')->only('store', 'update', 'destroy');
    }

    public function store(Request $request, Task $task)
    {
        $subTask = new SubTask();
        $subTask->title = $request->title;
        $subTask->status = $request->status;

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'subTask not found',
            ], 404);
        } else {
            $subTask->task_id = $task->id;
            $subTask->save();
            return $subTask;
        }
    }

    public function update(Request $request,SubTask $subTask)
    {
        $subTask->title = $request->title;
        $subTask->status = $request->status;
        $subTask->due = $request->due;

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'status' => 'required',
            'due' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'error',
            ], 404);
        } else {
            $subTask->save();
            return $subTask;
        }
    }

    public function destroy(SubTask $subTask)
    {
        $subTask->delete();
        return response()->json([
            'message' => 'sub_task deleted successfully',
        ], 200);
    }
}

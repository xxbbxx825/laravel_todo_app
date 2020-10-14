<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json([
            'message' => 'ok',
            'data' => $tasks
        ], 200, [], JSON_UNESCAPED_UNICODE);
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
        $task->state = $request->state;

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'state' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'task not found',
            ], 404);
        } else {
            $task->save();
            return response()->json([
                'message' => 'task created successfully',
                'data' => $task
            ], 200);
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
        $task->state = $request->state;

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'state' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'task not found',
            ], 404);
        } else {
            $task->save();
            return response()->json([
                'message' => 'task updated successfully',
                'data' => $task
            ], 200);
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

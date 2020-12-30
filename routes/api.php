<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('tasks', 'App\Http\Controllers\TasksController@indexAll');
Route::group(['middleware' => ['jwt.auth']], function () {
    Route::apiresource('tasks','App\Http\Controllers\TasksController')->except('index');
    Route::get('mytasks', 'App\Http\Controllers\TasksController@index', function ($user) {
        return $user;
    })->name('tasks.index');
    Route::get('tasks/{task}/sub_tasks', 'App\Http\Controllers\TasksController@showSubTasks', function ($task) {
        return $task;
    })->name('tasks.sub_tasks');
});

Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    // Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::get('me', 'App\Http\Controllers\AuthController@me');
});

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

Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');
Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

    Route::apiresource('tasks','App\Http\Controllers\TasksController')->except('index');
    Route::get('tasks', 'App\Http\Controllers\TasksController@index', function ($user) {
        return $user;
    })->name('tasks.index');

    Route::apiresource('sub_tasks','App\Http\Controllers\SubTasksController')->except('index');
    Route::get('tasks/{task}/sub_tasks', 'App\Http\Controllers\SubTasksController@index', function ($task) {
        return $task;
    })->name('sub_tasks.index');


});

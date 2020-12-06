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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', 'App\Http\Controllers\UserController@index');
Route::get('sub/{id}', 'App\Http\Controllers\UserController@getSubordinatesIds');

Route::get('info/{id}', 'App\Http\Controllers\UserController@info');

Route::get('tasks/{id}/', 'App\Http\Controllers\TaskController@getTasks');
Route::post('task', 'App\Http\Controllers\TaskController@store');
Route::put('task/{id}', 'App\Http\Controllers\TaskController@updateTask');

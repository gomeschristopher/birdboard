<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => 'auth'], function () {
    Route::resource('/projects', 'ProjectsController');

    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
    Route::patch('/tasks/{task}', 'ProjectTasksController@update');

    Route::post('/projects/{project}/invitations', 'ProjectInvitationsController@store');

    Route::post('/projects', 'ProjectsController@store');
});

Auth::routes();

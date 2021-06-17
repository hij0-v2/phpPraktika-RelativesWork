<?php

use App\Http\Controllers\Admin\AdminTaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\User\UserTaskController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{id}/completed', [TaskController::class, 'completed']);

Route::group(['middleware' => 'auth'], function (){
    Route::resource('tasks', TaskController::class);
});


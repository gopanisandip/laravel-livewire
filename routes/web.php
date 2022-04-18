<?php

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

Route::view('login','livewire.home')->name('login');

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['checkAdmin']], function () {
        Route::view('admin/tasks','livewire.AdminTasks');

    });

    Route::group(['middleware' => ['checkStaff']], function () {
        Route::view('staff/tasks', 'livewire.StaffTasks');
        Route::view('staff/tasks/{id}', 'livewire.staffwork');
    });

});

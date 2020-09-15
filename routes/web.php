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

Route::get('/', function() {
  return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

//logout処理
Route::get('logout', 'HomeController@logout')->name('logout');

//タスク
Route::resource('tasks', 'TaskController');
Auth::routes(['verify'=>true]);

//カレンダー
Route::get('/calendar', 'CalendarController@show');







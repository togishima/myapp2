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
Route::get('/calendar', 'Calendar\CalendarController@show');
Route::get('/calendar/{year}/{month}', 'Calendar\Controller@specificMonth')
      ->where(['year'=> '[0-9]+', 'month' => '[0-9]+']);
//シフト設定画面
Route::get('/calendar/holiday_setting', 'Calendar\HolidaySettingController@form')->name("holiday_setting");
Route::post('/calendar/holiday_setting', 'Calendar\HolidaySettingController@update')->name("update_holiday_setting");






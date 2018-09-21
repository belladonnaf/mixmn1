<?php

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

// Example Routes
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

$site_status = DB::select('select * from site_status limit 0,1')[0];
  
Route::view('/', 'members/login',['site_status' => $site_status])->name('login');

Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy')->name('logout');

Route::view('/settings/ui', 'settings.ui')->middleware('session.has.user');
Route::get('/settings/set-ui','SettingsController@storeUI')->name('settings.set-ui');

Route::view('/archives/index', 'archives/index')->middleware('archives.index');

Route::view('/dashboard', 'dashboard');
Route::view('/examples/plugin', 'examples.plugin');
Route::view('/examples/blank', 'examples.blank');



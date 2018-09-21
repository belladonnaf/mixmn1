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

$site_status = DB::select('select * from site_status limit 0,1');
var_dump($site_status);
  
Route::view('/', 'members/login',['site_status' => $site_status]);

Route::view('/dashboard', 'dashboard');
Route::view('/examples/plugin', 'examples.plugin');
Route::view('/examples/blank', 'examples.blank');

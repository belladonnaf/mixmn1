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
  
Route::get('/', 'SessionsController@create')->name('login');

Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy')->name('logout');

Route::view('/settings/ui', 'settings.ui')->middleware('session.has.user');
Route::get('/settings/set-ui','SettingsController@storeUI')->name('settings.set-ui');

Route::get('/archives/index/{f_date?}', 'ArchivesController@index')->name('archives.index');

Route::get('/archives/genre/index/{f_genre?}', function($f_genre=''){
			if(!$f_genre){
				return Route::get('/archives/genre/index','ArchivesController@genreIndex')->name('archives.genre.index');
			} else {
				return Route::get('/archives/genre/{f_genre}','ArchivesController@genreList')->name('archives.genre.list');
			}
		});

Route::get('/archives/group/index/{f_group?}', function($f_group=''){
			if(!$f_group){
				return 'ArchivesController@groupIndex';
			} else {
				return 'ArchivesController@groupList';
			}
		})->name('archives.group.index');

Route::view('/dashboard', 'dashboard');
Route::view('/examples/plugin', 'examples.plugin');
Route::view('/examples/blank', 'examples.blank');



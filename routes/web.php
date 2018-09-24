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

/* Login */
  
Route::get('/', 'SessionsController@create')->name('login');

Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy')->name('logout');

/* Archives Related */

Route::get('/archives/index/{f_date?}', 'ArchivesController@index')->name('archives.index')->middleware('session.has.user');

Route::get('/archives/genre', 'ArchivesController@genreIndex')->name('archives.genre.base')->middleware('session.has.user');
Route::get('/archives/genre/index', 'ArchivesController@genreIndex')->name('archives.genre.index')->middleware('session.has.user');
Route::get('/archives/genre/{f_genre}','ArchivesController@genreList')->name('archives.genre.list')->middleware('session.has.user');


Route::get('/archives/group', 'ArchivesController@groupIndex')->name('archives.group.base')->middleware('session.has.user');
Route::get('/archives/group/index', 'ArchivesController@groupIndex')->name('archives.group.index')->middleware('session.has.user');
Route::get('/archives/group/{f_group}','ArchivesController@groupList')->name('archives.group.list')->middleware('session.has.user');

Route::get('/search','ArchivesController@getSearch')->name('album.search')->middleware('session.has.user');
Route::get('/album/{album_id}','ArchivesController@show')->name('album.show')->middleware('session.has.user');

/* Settings Related */

Route::view('/settings/ui', 'settings.ui')->middleware('session.has.user');
Route::get('/settings/set-ui','SettingsController@storeUI')->name('settings.set-ui')->middleware('session.has.user');

/* API Related */

Route::get('/api/album/{album_id}','ArchivesController@getJson');
Route::get('/api/favorites/set/{album_id}','ArchivesController@setFavorite');

Route::get('/api/settings/myui/set/{ui_id}','SettingsController@setMyUI');
Route::get('/api/settings/mygenre/set/{genre_group_id}','SettingsController@setMyGenre');


Route::view('/dashboard', 'dashboard');
Route::view('/examples/plugin', 'examples.plugin');
Route::view('/examples/blank', 'examples.blank');



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
Route::post('/profile/update','SessionsController@updateProfile');

/* Archives Related */

Route::get('/archives/index/{f_date?}', 'ArchivesController@index')->name('archives.index')->middleware('session.has.user');

Route::get('/archives/genre', 'ArchivesController@genreIndex')->name('archives.genre.base')->middleware('session.has.user');
Route::get('/archives/genre/index', 'ArchivesController@genreIndex')->name('archives.genre.index')->middleware('session.has.user');
Route::get('/archives/genre/{f_genre}','ArchivesController@genreList')->name('archives.genre.list')->middleware('session.has.user');


Route::get('/archives/group', 'ArchivesController@groupIndex')->name('archives.group.base')->middleware('session.has.user');
Route::get('/archives/group/index', 'ArchivesController@groupIndex')->name('archives.group.index')->middleware('session.has.user');
Route::get('/archives/group/{f_group}','ArchivesController@groupList')->name('archives.group.list')->middleware('session.has.user');

/* Search Related */

Route::get('/search','ArchivesController@getSearch')->name('album.search')->middleware('session.has.user');

/* Album Related */

Route::get('/album/{album_id}','ArchivesController@show')->name('album.show')->middleware('session.has.user');

/* Favorite Related */

Route::get('/favorites/index','FavoritesController@index')->name('favorites.index')->middleware('session.has.user');
Route::get('/favorites/del/{album_id}','FavoritesController@delete')->name('favorites.delete')->middleware('session.has.user');
Route::get('/stream-sets/index','FavoritesController@streamSet')->name('favorites.stream-set')->middleware('session.has.user');
Route::get('/stream-set/{stream_set_id}','FavoritesController@showStreamSet')->name('favorites.show-stream-set')->middleware('session.has.user');

Route::get('/recommended/index','ArchivesController@recommendedIndex')->name('recommended.index')->middleware('session.has.user');

/* Settings Related */

Route::view('/settings/ui', 'settings.ui')->middleware('session.has.user');
Route::get('/settings/set-ui','SettingsController@storeUI')->name('settings.set-ui')->middleware('session.has.user');

/* API Related */

Route::get('/api/album/{album_id}','ArchivesController@getJson');
Route::get('/api/favorites/set/{album_id}','FavoritesController@setFavorite');

Route::get('/api/stream-set/{set_id}','FavoritesController@getStreamSetJson');

Route::get('/api/settings/myui/set/{ui_id}','SettingsController@setMyUI');
Route::get('/api/settings/mygenre/set/{genre_group_id}','SettingsController@setMyGenre');

Route::get('/api/search/{keyword}/{page?}','ArchivesController@searchJson');
Route::post('/api/favorites/reorder','FavoritesController@reorder');
Route::post('/api/favorites/create-stream-set','FavoritesController@createStreamset');
Route::post('/api/favorites/save-stream-set','FavoritesController@saveStreamset');
Route::post('/api/favorites/delete-stream-detail','FavoritesController@deleteStreamDetail');

Route::view('/pages/how-to-fix-player', 'pages/howtofixplayer');
Route::view('/pages/apk-installation', 'pages/apkinstallation');

Route::view('/dashboard', 'dashboard');
Route::view('/examples/plugin', 'examples.plugin');
Route::view('/examples/blank', 'examples.blank');
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

Route::view('/', 'welcome');

Route::namespace('Auth')->group(function () {
    Route::name('login')->get('login', 'LoginController@redirect');
    Route::get('callback', 'LoginController@callback');
    Route::name('logout')->post('logout', 'LoginController@logout');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('albums', 'AlbumController');

    Route::resource('mediaitems', 'MediaController');

    Route::name('mediaitems.album')->get('mediaitems/album/{id}', 'MediaController@album');

    Route::view('upload', 'form')->name('form');
    Route::name('upload')->post('upload', 'UploadController');
});

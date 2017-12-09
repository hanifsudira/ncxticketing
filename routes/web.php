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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
    
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('home', [
        'as'    => 'admin.home',
        'uses'  => 'AdminController@index'
    ]);

    Route::get('kelolauser', [
        'as'    => 'admin.kelolauser',
        'uses'  => 'AdminController@kelolauser'
    ]);

    Route::get('kelolajenis', [
        'as'    => 'admin.kelolajenis',
        'uses'  => 'AdminController@kelolajenis'
    ]);
});

Route::group(['prefix' => 'user', 'middleware' => ['auth']], function() {
    Route::get('home', [
        'as'    => 'user.home',
        'uses'  => 'UserController@index'
    ]);

    Route::get('createTicket', [
        'as'    => 'user.createTicket',
        'uses'  => 'UserController@createTicket'
    ]);
});
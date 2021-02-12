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
    #return view('welcome');
    return view('dashboard');
});

Route::get('/login', 'LoginController@index')->name('login.index');
Route::post('/login/auth', 'LoginController@auth')->name('login.auth');
Route::get('/login/sair', 'LoginController@logout')->name('login.logout');

Route::prefix('usuarios')->group(function(){
    Route::get('/',               'UserController@index' )->name('usuarios.index');
    Route::get('novo',            'UserController@create')->name('usuarios.create');
    Route::post('store',          'UserController@store' )->name('usuarios.store');
    Route::get('edit/{user}',     'UserController@edit'  )->name('usuarios.edit');
    #Route::put('edit/{password}', 'UserController@update')->name('usuarios.update');
    #Route::get('{password}',      'UserController@show'  )->name('usuarios.show');
    #Route::post('visualizar',     'UserController@show'  )->name('usuarios.show');

    Route::delete('destroy/{user}', 'UserController@destroy')->name('usuarios.destroy');
});

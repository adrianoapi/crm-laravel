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

Route::prefix('usuarios')->group(function(){
    #Route::get('/',               'UserController@index' )->name('usuarios.index');
    Route::get('novo',            'UserController@create')->name('usuarios.create');
    /*Route::post('store',          'UserController@store' )->name('usuarios.store');
    Route::get('edit/{password}', 'UserController@edit'  )->name('usuarios.edit');
    Route::put('edit/{password}', 'UserController@update')->name('usuarios.update');
    Route::get('{password}',      'UserController@show'  )->name('usuarios.show');
    Route::post('visualizar',     'UserController@show'  )->name('usuarios.show');*/

    Route::delete('destroy/{password}', 'UserController@destroy')->name('usuarios.destroy');
});

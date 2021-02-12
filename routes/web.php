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
    return redirect()->route('usuarios.index');
});

Route::get('envio-email', function(){
    $user = new stdClass;
    $user->name = 'Adriano';
    $user->email = 'adrianoapi@hotmail.com';
    \Illuminate\Support\Facades\Mail::send(new \App\Mail\passwordRecover($user));
    #return new \App\Mail\passwordRecover($user);
});

Route::get('login', 'LoginController@index')->name('auth.login');
Route::post('/login/auth', 'LoginController@auth')->name('login.auth');
Route::get('/login/sair', 'LoginController@logout')->name('login.logout');

Auth::routes();

Route::prefix('usuarios')->group(function(){
    Route::get('/',           'UserController@index' )->name('usuarios.index');
    Route::get('novo',        'UserController@create')->name('usuarios.create');
    Route::post('store',      'UserController@store' )->name('usuarios.store');
    Route::get('edit/{user}', 'UserController@edit'  )->name('usuarios.edit');
    Route::put('edit/{user}', 'UserController@update')->name('usuarios.update');
    #Route::get('{user}',      'UserController@show'  )->name('usuarios.show');
    #Route::post('visualizar',     'UserController@show'  )->name('usuarios.show');

    Route::delete('destroy/{user}', 'UserController@destroy')->name('usuarios.destroy');
});

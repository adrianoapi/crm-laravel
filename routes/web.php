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
    return redirect()->route('dashboard.index');
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
Route::get('/login/recover', 'LoginController@recover')->name('login.recover');
Route::post('/login/recover/do', 'LoginController@recoverDo')->name('login.recover.do');

Auth::routes();

Route::prefix('dashboard')->group(function(){
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
});

Route::prefix('segunda-fase')->group(function(){
    Route::get('/', 'DefaultingController@index')->name('defaultings.index');
    Route::get('novo',        'DefaultingController@create')->name('defaultings.create');
    Route::post('store',      'DefaultingController@store' )->name('defaultings.store');
    Route::get('show/{defaulting}', 'DefaultingController@show'  )->name('defaultings.show');
    Route::get('edit/{defaulting}', 'DefaultingController@edit'  )->name('defaultings.edit');
    Route::put('edit/{defaulting}', 'DefaultingController@update')->name('defaultings.update');

    Route::delete('destroy/{defaulting}', 'DefaultingController@destroy')->name('defaultings.destroy');
});

Route::prefix('alunos')->group(function(){
    Route::get('/', 'StudentController@index')->name('alunos.index');
    Route::get('novo',        'StudentController@create')->name('alunos.create');
    Route::post('store',      'StudentController@store' )->name('alunos.store');
    Route::get('edit/{student}', 'StudentController@edit'  )->name('alunos.edit');
    Route::put('edit/{student}', 'StudentController@update')->name('alunos.update');

    Route::delete('destroy/{student}', 'StudentController@destroy')->name('alunos.destroy');
});

Route::prefix('unidades')->group(function(){
    Route::get('/', 'UnityController@index')->name('unidades.index');
    Route::get('novo',        'UnityController@create')->name('unidades.create');
    Route::post('store',      'UnityController@store' )->name('unidades.store');
    Route::get('edit/{unity}', 'UnityController@edit'  )->name('unidades.edit');
    Route::put('edit/{unity}', 'UnityController@update')->name('unidades.update');

    Route::delete('destroy/{unity}', 'UnityController@destroy')->name('unidades.destroy');
});

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

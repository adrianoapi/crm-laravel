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
    Route::get('pdf',      'DefaultingController@pdf' )->name('defaultings.pdf');
    Route::get('lixeira',      'DefaultingController@trash' )->name('defaultings.trash');
    Route::post('store',      'DefaultingController@store' )->name('defaultings.store');
    Route::get('show/{defaulting}', 'DefaultingController@show'  )->name('defaultings.show');
    Route::get('edit/{defaulting}', 'DefaultingController@edit'  )->name('defaultings.edit');
    Route::put('edit/{defaulting}', 'DefaultingController@update')->name('defaultings.update');

    Route::delete('destroy/{defaulting}', 'DefaultingController@destroy')->name('defaultings.destroy');
});

Route::prefix('segunda-fase-negociacao')->group(function(){
    Route::post('store',      'DefaultingTradingController@store' )->name('defaultingTradings.store');
});

Route::prefix('segunda-fase-historico')->group(function(){
    Route::post('store', 'DefaultingHistoryController@store' )->name('defaultingHistories.store');
});

Route::prefix('cheque')->group(function(){
    Route::get('/', 'BankChequeController@index')->name('bankCheques.index');
    Route::get('novo',        'BankChequeController@create')->name('bankCheques.create');
    Route::get('pdf',      'BankChequeController@pdf' )->name('bankCheques.pdf');
    #Route::get('lixeira',      'BankChequeController@trash' )->name('bankCheques.trash');
    Route::post('store',      'BankChequeController@store' )->name('bankCheques.store');
    Route::get('show/{bankCheque}', 'BankChequeController@show'  )->name('bankCheques.show');
    Route::get('edit/{bankCheque}', 'BankChequeController@edit'  )->name('bankCheques.edit');
    Route::put('edit/{bankCheque}', 'BankChequeController@update')->name('bankCheques.update');

    Route::delete('destroy/{graphic}', 'BankChequeController@destroy')->name('bankCheques.destroy');
});

Route::prefix('cheque-negociacao')->group(function(){
    Route::post('store',      'BankChequeTradingController@store' )->name('bankChequeTradings.store');
});

Route::prefix('cheque-historico')->group(function(){
    Route::post('store', 'BankChequeHistoryController@store' )->name('bankChequeHistories.store');
});

Route::prefix('grafica')->group(function(){
    Route::get('/', 'GraphicController@index')->name('graphics.index');
    Route::get('novo',        'GraphicController@create')->name('graphics.create');
    Route::get('pdf',      'GraphicController@pdf' )->name('graphics.pdf');
    #Route::get('lixeira',      'GraphicController@trash' )->name('graphics.trash');
    Route::post('store',      'GraphicController@store' )->name('graphics.store');
    Route::get('show/{graphic}', 'GraphicController@show'  )->name('graphics.show');
    Route::get('edit/{graphic}', 'GraphicController@edit'  )->name('graphics.edit');
    Route::put('edit/{graphic}', 'GraphicController@update')->name('graphics.update');

    Route::delete('destroy/{graphic}', 'GraphicController@destroy')->name('graphics.destroy');
});

Route::prefix('grafica-negociacao')->group(function(){
    Route::post('store',      'GraphicTradingController@store' )->name('graphicTradings.store');
});

Route::prefix('grafica-historico')->group(function(){
    Route::post('store', 'GraphicHistoryController@store' )->name('graphicHistories.store');
});

Route::prefix('alunos')->group(function(){
    Route::get('/', 'StudentController@index')->name('alunos.index');
    Route::get('novo/{modulo}',        'StudentController@create')->name('alunos.create');
    Route::post('store',      'StudentController@store' )->name('alunos.store');
    Route::get('edit/{student}', 'StudentController@edit'  )->name('alunos.edit');
    Route::put('edit/{student}', 'StudentController@update')->name('alunos.update');

    Route::delete('destroy/{student}', 'StudentController@destroy')->name('alunos.destroy');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail as MailF;
use App\Mail\PasswordRecover;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'active' => 1
        ];

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return \redirect()->back()->withInput()->withErrors(['Email informado não é válido!']);
        }

        if(Auth::attempt($credentials)){
            return \redirect()->route('history.index');
        }

        return \redirect()->back()->withInput()->withErrors(['Dados informados não conferem!']);
    }

    public function logout()
    {
        Auth::logout();
        return \redirect()->route('login');
    }

    public function recover()
    {
        return view('auth.recover');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recoverDo(Request $request)
    {
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return \redirect()->back()->withInput()->withErrors(['Email informado não é válido!']);
        }

        $user = \App\User::where('email', 'adrianoapi@hotmail.com')
                        ->where('active', true)
                        ->limit(1)
                        ->get();

        MailF::send(new PasswordRecover($user));
       #MailF::to($user)->send(new PasswordRecover($user));
        #return new \App\Mail\passwordRecover($user);
    }
}

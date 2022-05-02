<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

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
        die();
        $user = \App\User::where('email', $request->email)
                        ->where('active', true)
                        ->limit(1)
                        ->get();
        $details = [
            'title' => 'Mail recover password',
            'body' => 'Your new passord: xpto'
        ];

        var_dump(Mail::to($request->email)->send(new TestMail($details)));
    }
}

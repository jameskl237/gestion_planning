<?php

namespace App\Http\Controllers;

use App\Http\Requests\authRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function dologin(authRequest $request)
    {
        $credentials = $request->validated();
        // dd(Auth::attempt($credentials));

        if( Auth::attempt($credentials)){
            session()->regenerate();
            return redirect()->route('welcome');
        }
        return to_route('auth.login')->withErrors('email=>invalid')->onlyInput('email');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}

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
            toastr()->success('Success','Connexion reussie');
            return redirect()->route('welcome');
        }
        toastr()->error('erreur', "une erreur s'est produite");
        return to_route('auth.login')->withErrors('email=>invalid')->onlyInput('email');
    }


    public function logout()
    {
        Auth::logout();
        toastr()->success('deconnexion','');
        return redirect()->route('auth.login');
    }

    public function dologin_api(authRequest $request)
    {
        $credentials = $request->validated();
        // dd(Auth::attempt($credentials));

        if( Auth::attempt($credentials)){
            session()->regenerate();
            // return redirect()->route('welcome');
            return response()->json([
                'message'=>'connexion reussie'
            ],200);
        }else{
            return response()->json([
                'message' => 'Connexion echoue'
            ], 401);
        }
    }


}

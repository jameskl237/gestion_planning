<?php

namespace App\Http\Controllers;

use App\Http\Requests\authRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function dologin(authRequest $request)
    {
        try {
            $credentials = $request->validated();
            if( Auth::attempt($credentials)){
                session()->regenerate();
                toastr()->success('success','Connexion reussie');
                return redirect()->route('welcome');
            }
            toastr()->error('error', "une erreur s'est produite");
            return to_route('auth.login')->withErrors('email=>invalid')->onlyInput('email');

        }catch (\Exception $e) {
            toastr()->error('error', "Une Erreur c'est produite");
            return back()->with('error'. $e->getMessage());
        }
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


    public function navbar_user()
    {
        $user = auth()->user();
        return view('layouts.base', compact('user'));
    }


}

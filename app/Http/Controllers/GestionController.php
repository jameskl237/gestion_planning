<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GestionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $layouts = $user->role->nom == 'VDPSAA' ? 'layouts.base2' : 'layouts.base';
        return view('gestion', compact('layouts'));
    }

    public function affiche_personnel()
    {

        $user = auth()->user();
        $layouts = $user->role->nom == 'VDPSAA' ? 'layouts.base2' : 'layouts.base';
        return view('affiche_personnel', compact('layouts'));
    }
}

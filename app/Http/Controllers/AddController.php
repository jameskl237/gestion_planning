<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Role;
use App\Models\Salle;
use Illuminate\Http\Request;

class AddController extends Controller
{
    public function remplir()
    {
        return view('ajout');
    }

    public function add_dep(Request $request)
    {
        try {
            $dep = new Departement();
            $dep->nom = $request->namedep;
            $dep->save();

            toastr()->success('success', 'departement ajoute');
            return redirect()->route('remplir_bd');
        } catch (\Throwable $th) {
            toastr()->error('error', 'une erreur s\'est produite');
            return redirect()->route('remplir_bd');
        }
    }

    public function add_role(Request $request)
    {
        try {
            $Role = new Role();
            $Role->nom = $request->namerole;
            $Role->libelle = $request->libelle;
            $Role->rang = $request->rang;
            $Role->save();

            toastr()->success('success', 'Role ajoute');
            return redirect()->route('remplir_bd');
        } catch (\Throwable $th) {
            toastr()->error('error', 'une erreur s\'est produite');
            return redirect()->route('remplir_bd');
        }
    }

    public function add_sal(Request $request)
    {
        try {
            $sal = new Salle();
            $sal->name = $request->namesal;
            $sal->save();

            toastr()->success('success', 'salle ajoute');
            return redirect()->route('remplir_bd');
        } catch (\Throwable $th) {
            toastr()->error('error', 'une erreur s\'est produite');
            return redirect()->route('remplir_bd');
        }
    }
}

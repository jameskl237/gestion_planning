<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::where('rang', '!=', '1')->get();
        $departement = Departement::all();
        return view('inscription', compact('role', 'departement'));
    }

    public function profil()
    {
        $user = auth()->user();
        $layouts = $user->role->nom == 'VDPSAA' ? 'layouts.base2' : 'layouts.base';
        $role = Role::find($user->role_id);
        $dep = Departement::find($user->departement_id);
        return view('profil', compact('user', 'role', 'dep', 'layouts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Vérifier si tous les champs requis sont remplis
            $requiredFields = ['name', 'email', 'password'];
            foreach ($requiredFields as $field) {
                if (empty($request->$field)) {
                    toastr()->error('error', "Remplissez tous les champs");
                    return redirect()->back()->with('message', 'Remplissez tous les champs');
                }
            }

            // Créer un nouvel utilisateur
            $new_user = new User();
            $new_user->name = $request->name;
            $new_user->prenom = $request->prenom;
            $new_user->email = $request->email;
            $new_user->password = Hash::make($request->password);
            $new_user->telephone = $request->telephone;
            $new_user->color = null;

            // Récupérer l'ID du rôle en fonction du nom du rôle
            $role = Role::where('nom', $request->role)->first();

            if ($role) {
                $new_user->role_id = $role->id;
            } else {
                toastr()->error('error', "Le rôle spécifié n\'a pas été trouvé");
                return redirect()->back()->with('erreur', 'Le rôle spécifié n\'a pas été trouvé');
            }

            $new_user->departement_id = $request->departement;

            // Gérer l'upload de l'image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $new_user->image = $imageName ? $imageName : 'NULL';
            }

            $new_user->save();
            toastr()->success('success', "Utilisateur enregistré avec succès");
            return redirect()->route('auth.login');
        } catch (\Exception $e) {
            toastr()->error('error', "Une erreur s\'est produite ");
            return redirect()->back()->with('error', 'Une erreur s\'est produite : ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPersonnel()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $layouts = $user->role->nom == 'VDPSAA' ? 'layouts.base2' : 'layouts.base';
        $tab = collect();

        if ($user->departement->nom == 'NULL' && $user->role->rang == 1) {

            $tab = User::whereHas('role', function ($query) {
                $query->where('rang', '>', 1);
            })->get();
        } elseif ($user->departement->nom != 'NULL' && $user->role->rang >= 1) {

            $tab = User::whereHas('role', function ($query) use ($user) {
                $query->where('rang', '>', $user->role->rang);
            })->where('departement_id', $user->departement_id)->get();
        }

        return view('programmer_personnel', compact('tab', 'layouts'));
    }

    public function info()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $layouts = $user->role->nom == 'VDPSAA' ? 'layouts.base2' : 'layouts.base';
        $tab = collect();

        if ($user->departement->nom == 'NULL' && $user->role->rang == 1) {

            $tab = User::whereHas('role', function ($query) {
                $query->where('rang', '>', 1);
            })->get();
        } elseif ($user->departement->nom != 'NULL' && $user->role->rang >= 1) {

            $tab = User::whereHas('role', function ($query) use ($user) {
                $query->where('rang', '>', $user->role->rang);
            })->where('departement_id', $user->departement_id)->get();
        }
        return view('info', compact('tab', 'layouts'));
    }

    public function changePassword(Request $request)
    {
        try {
            $user = auth()->user();

            // Vérifier que tous les champs nécessaires sont remplis
            if (empty($request->current_password) || empty($request->password) || empty($request->password_confirmation)) {
                toastr()->error('Error', 'Remplir tous les champs');
                return redirect()->back();
            }

            // Vérifier que le mot de passe actuel est correct
            if (!Hash::check($request->current_password, $user->password)) {
                toastr()->error('Error', 'Erreur sur l\'actuel mot de passe');
                return redirect()->back();
            }

            // Vérifier que le nouveau mot de passe et sa confirmation correspondent
            if ($request->password !== $request->password_confirmation) {
                toastr()->error('Error', 'confirmation echouee');
                return redirect()->back();
            }

            // Mettre à jour le mot de passe de l'utilisateur
            $user->password = Hash::make($request->password);
            $user->save();

            toastr()->success('Success', 'Mot de passe modifie');
            return redirect()->back();
        } catch (\Throwable $th) {
            toastr()->error('Error', 'Une erreur s\'est produite ');
            return redirect()->back()->with('error', 'une erreur s\'est produite : ' . $th->getMessage());
        }
    }
}

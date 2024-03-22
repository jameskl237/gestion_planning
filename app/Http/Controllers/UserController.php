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
        $role = Role::where('rang','!=','1')->get();
        $departement = Departement::all();
        return view('inscription', compact('role', 'departement'));
    }

    public function profil()
    {
        $user= auth()->user();
        return view('profil',compact('user'));
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
                    toastr()->error('erreur', "Remplissez tous les champs");
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
                toastr()->error('erreur', "Le rôle spécifié n\'a pas été trouvé");
                return redirect()->back()->with('erreur', 'Le rôle spécifié n\'a pas été trouvé');
            }

            // Récupérer l'ID du département en fonction du nom du département
            $dep = Departement::where('nom', $request->departement)->first();
            $new_user->departement_id = $dep->id ? $dep->id :'';

            // if ($dep) {
            //     $new_user->departement_id = $dep->id;
            // } else {
            //     toastr()->error('erreur', "Le département spécifié n\'a pas été trouvé");
            //     return redirect()->back()->with('message', 'Le département spécifié n\'a pas été trouvé');
            // }

            // Gérer l'upload de l'image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $new_user->image = $imageName;
            }

            $new_user->save();
            // dd('1');
            toastr()->success('success',"Utilisateur enregistré avec succès");
            return redirect()->route('auth.login');
        } catch (\Exception $e) {
            // dd('1');
            toastr()->error('erreur', "Une erreur s\'est produite ");
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
        if($user->deparetement_id == 'NULL'){
            $tab = User::where('role_id', '>', $user->role_id)->get();
        }else {
            $tab = User::where('role_id', '>', $user->role_id)
            ->where('departement_id', '=', $user->departement_id)
            ->get();
        }
        return view('programmer_personnel', compact('tab'));
    }
}

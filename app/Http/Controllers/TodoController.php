<?php

namespace App\Http\Controllers;

use App\Http\Requests\createtodo;
use App\Models\Todo;
use App\Models\Todo_user;
use App\Models\User;
use App\Models\Role;
use App\Models\Todo_planning;
use App\Models\Todo_salle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $us = Todo_user::where('user_id', $user->id)->get();
        $var = $us->pluck('todo_id');
        $arr = Todo::whereIn('id', $var)->get();
        return view('welcome', compact('arr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todocreate');
    }

    // Foction qui gere les notifications

    public function notification()
    {
        $user = auth()->user();
        $us = Todo_user::where('user_id', $user->id)
            ->where('is_view', '0')->get();
        $var = $us->pluck('todo_id');
        $table = Todo::whereIn('id', $var)
            ->where('user_id', '!=', $user->id)->get();
        return view('layouts.base', compact('table'));
    }

    // Fonction pour gerer les notifications  vues

    public function is_view($id)
    {

        $task = Todo_user::where('todo_id', $id)->first();
        $task->is_view = '1';
        $task->save();
        return redirect()->back();
    }

    // Fonction de redirection pour programmer le personnel

    public function programmer()
    {
        return view('programmer_personnel');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // s'ajouter une tache a soi meme

    public function store(Request $request)
    {
        try {
            if (
                empty($request->name) ||
                empty($request->date_debut) ||
                empty($request->date_fin) ||
                empty($request->heure_debut) ||
                empty($request->heure_fin)
            ) {
                toastr()->error('erreur', 'Remplissez les champs exiges');
                return redirect()->route('welcome');
            } else {
                $user = auth()->user();
                $todo = new Todo();

                $todo->name = $request->name;
                $todo->description = $request->description;
                $todo->date_debut = $request->date_debut;
                $todo->date_fin = $request->date_fin;
                $todo->heure_debut = $request->heure_debut;
                $todo->heure_fin = $request->heure_fin;
                $todo->jour = '';
                $todo->user_id = $user->id;
                $todo->save();

                $liaison = new Todo_user();
                $liaison->user_id = $user->id;
                $liaison->todo_id = $todo->id;
                $liaison->save();

                toastr()->success('Successs', 'Operation reussie');
                return redirect()->route('welcome')->with('success');
            }
        } catch (\Exception $e) {
            toastr()->error('Operation reussie', "Une Erreur c'est produite");
            return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
        }
    }

    // affecter une tache a son personnel

    public function store_sub(Request $request)
    {
        try {
            $user = auth()->user();
            $todo = new Todo();
            $todo->name = $request->name;
            $todo->description = $request->description;
            $todo->date_debut = $request->date_debut;
            $todo->date_fin = $request->date_fin;
            $todo->heure_debut = $request->heure_debut;
            $todo->heure_fin = $request->heure_fin;
            $todo->jour = '';
            $todo->user_id = $user->id;
            $todo->save();

            $request->validate([
                'sub' => 'required|array|min:1', // Au moins une checkbox doit être cochée
            ]);

            $selectedUserIds = $request->sub; // Obtenez les ID des utilisateurs sélectionnés
            $selectedUsers = User::whereIn('id', $selectedUserIds)->get(); // Récupérez les utilisateurs sélectionnés

            foreach ($selectedUsers as $users) {
                $liaison = new Todo_user();
                $liaison->user_id = $users->id;
                $liaison->todo_id = $todo->id;
                $liaison->save();
            }

            toastr()->success('succes', 'Tache affectee');
            return redirect()->route('programmer');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */


    //modifier une tache

    public function edit(Request $request, $id)
    {

        try {
            $user = auth()->user();
            $todo = Todo::find($id);

            $todo->name = $request->name;
            $todo->description = $request->description;
            $todo->date_debut = $request->date_debut;
            $todo->date_fin = $request->date_fin;
            $todo->heure_debut = $request->heure_debut;
            $todo->heure_fin = $request->heure_fin;
            $todo->jour = '';
            $todo->user_id = $user->id;
            $todo->save();


            return redirect()->route('welcome')->with('success', 'Task successfully update');
        } catch (\Exception $e) {
            toastr()->error('erreur', "Une Erreur c'est produite");
            return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
        }
    }


    public function update(Request $request, Todo $todo)
    {
        $todo->update($request->validated());
        return redirect()->route('welcome')->with('success', 'Todo successfully edited');
        // return response()->json(['message' => 'Modification réussie !']);
    }

    public function destroy_web($id)
{
    try {
        $todo = Todo::find($id);
        if ($todo) {
            $todo_user = Todo_user::where('todo_id', $id)->delete();
            $todo_planning = Todo_planning::where('todo_id', $id)->delete();
            $todo_salle = Todo_salle::where('todo_id', $id)->delete();

            $todo->delete();

            return response()->json('ok');
        } else {
            return response()->json('off');
        }
    } catch (\Exception $e) {
        return response()->json('off');
    }
}

    public function info(Todo $todo)
    {
        return view('info', [
            'todo' => $todo
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */


    public function find($id)
    {
        $todo = Todo::findOrFail($id);
    }

    public function pagina($id)
    {
        $todo = Todo::paginate($id, ['name', 'description']);
    }

    // API FUNCTIONS

    public function indexapi(Request $request)
    {
        $arr = Todo::get();
        return response()->json([
            $arr
        ]);
    }

    public function destroy_api($id)
    {
        $todo = Todo::find($id);
        if (is_null($todo)) {
            return response()->json([
                'message' => 'tag not found'
            ], 404);
        }
        $tod = $todo;
        $todo->delete();
        return response()->json([
            'todo' => $tod,
            'message' => 'tache supprimee'
        ]);
    }

    public function update_api(Request $request, $id)
    {
        $todo = Todo::find($id);
        if (is_null($todo)) {
            return response()->json([
                'message' => 'tag not found'
            ], 404);
        }
        $todo->update($request->all());
        return response()->json([
            'tag' => $todo,
            'message' => 'tag update succesfully'
        ]);
    }

    public function store_api(Request $request)
    {
        $validated = validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $todo = Todo::create($request->all());
        return response()->json([
            'new todo' => $todo,
            'message' => 'tache creee avec succes'
        ], 201);
    }

    public function show_api($id)
    {
        $todo = Todo::find($id);
        return response()->json(
            $todo,
            200
        );
    }
}

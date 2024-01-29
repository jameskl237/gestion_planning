<?php

namespace App\Http\Controllers;

use App\Models\Planning;
use App\Models\Todo;
use App\Models\Todo_planning;
use App\Models\Todo_salle;
use App\Models\Salle;
use App\Models\Todo_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $planning = Planning::where('user_id', $user->id)->get();
        return view('plannings', compact('planning'));
    }

    public function affiche($id)
    {
        $todplan = Todo_planning::where('planning_id', $id)->get();
        $var = $todplan->pluck('todo_id');
        $task = Todo::whereIn('id', $var)->get();
        // dd($var);

        $to_sal = Todo_salle::whereIn('todo_id', $var)->get();
        $sa = $to_sal->pluck('salle_id');
        $sal = Salle::WhereIn('id',$sa)->get();

        $salle = Salle::all();
        return view('affiche_planning', compact('id', 'task','salle','sal'));
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
            $user = auth()->user();
            $planning = new Planning();
            $planning->name =  $request->name;
            $planning->description = $request->description;
            $planning->user_id = $user->id;
            $planning->save();

            toastr()->success('Successs', 'Operation reussie');
            return redirect()->route('plannings')->with('success');

        } catch (\Exception $e) {
            toastr()->error('error', "Une Erreur c'est produite");
            return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
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

    public function store_tache(Request $request, $id)
    {
        try {
            if (
                empty($request->name) ||
                empty($request->date_debut) ||
                empty($request->heure_debut) ||
                empty($request->heure_fin)
            ) {
                toastr()->error('erreur', 'Remplissez les champs exiges');
                return redirect()->route('affiche_planning');
            } else {
                $user = auth()->user();
                $todo = new Todo();

                $todo->name = $request->name;
                $todo->description = $request->description;
                $todo->date_debut = $request->date_debut;
                $todo->date_fin = $request->date_debut;
                $todo->heure_debut = $request->heure_debut;
                $todo->heure_fin = $request->heure_fin;
                $todo->jour = $request->jour;
                $todo->user_id = $user->id;
                $todo->save();

                $liaison = new Todo_planning();
                $liaison->todo_id = $todo->id;
                $liaison->planning_id = $id;
                $liaison->save();

                $salle = new Todo_salle();
                $salle->todo_id = $todo->id;
                $salle->salle_id = $request->salle;
                $salle->save();


                toastr()->success('Successs', 'Operation reussie');
                return view('affiche_planning', compact('jour'));
            }
        } catch (\Exception $e) {
            toastr()->error('echec', "Une Erreur c'est produite");
            // return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
            return back();
        }
    }
}

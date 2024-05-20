<?php

namespace App\Http\Controllers;

use App\Models\Planning;
use App\Models\Todo;
use App\Models\Todo_planning;
use App\Models\Todo_salle;
use App\Models\Salle;
use App\Models\Todo_user;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
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
        $planning = Planning::where('user_id', $user->id)
            ->where('type', 'cours')->get();
        return view('plannings', compact('planning'));
    }

    public function affiche($id)
    {
        $todplan = Todo_planning::where('planning_id', $id)->get();
        $var = $todplan->pluck('todo_id');
        $task = Todo::whereIn('id', $var)->get();

        $salle = Salle::all();
        $planning = Planning::find($id);

        $user = auth()->user();
        if ($user->deparetement_id == 'NULL') {
            $tab = User::where('role_id', '>', $user->role_id)->get();
        } else {
            $tab = User::where('role_id', '>', $user->role_id)
                ->where('departement_id', '=', $user->departement_id)
                ->get();
        }

        return view('affiche_planning', compact('id', 'task', 'salle', 'tab', 'planning'));
    }

    public function affiche_eval($id)
    {
        $todplan = Todo_planning::where('planning_id', $id)->get();
        $var = $todplan->pluck('todo_id');
        $ta = Todo::whereIn('id', $var)->get();

        $to_sal = Todo_salle::whereIn('todo_id', $var)->get();
        $sa = $to_sal->pluck('salle_id');
        $sal = Salle::WhereIn('id', $sa)->get();

        $salle = Salle::all();
        $i = 1;

        $user = auth()->user();
        if ($user->deparetement_id == 'NULL') {
            $tab = User::where('role_id', '>', $user->role_id)->get();
        } else {
            $tab = User::where('role_id', '>', $user->role_id)
                ->where('departement_id', '=', $user->departement_id)
                ->get();
        }

        return view('affiche_eval', compact('id', 'ta', 'salle', 'sal', 'i', 'tab'));
    }

    public function getPdf($id)
    {
        $todplan = Todo_planning::where('planning_id', $id)->get();
        $var = $todplan->pluck('todo_id');
        $task = Todo::whereIn('id', $var)->get();

        $to_sal = Todo_salle::whereIn('todo_id', $var)->get();
        $sa = $to_sal->pluck('salle_id');
        $sal = Salle::WhereIn('id', $sa)->get();

        return PDF::loadView('affiche_planning', compact('id', 'task', 'salle', 'sal'))
            ->setPaper('a4', 'landscape')
            ->setWarnings(false)
            ->save(public_path("storage/documents/calendar.pdf"))
            ->stream();
    }

    public function generatePDF()
    {
        $pdf = PDF::loadView('pdf');
        return $pdf->download('planning.pdf');
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
            $planning->type = 'cours';
            $planning->user_id = $user->id;
            $planning->save();

            toastr()->success('Success', 'Operation reussie');
            return redirect()->route('plannings')->with('success');
        } catch (\Exception $e) {
            toastr()->error('error', "Une Erreur c'est produite");
            return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
        }
    }

    public function store_eval(Request $request)
    {
        try {
            $user = auth()->user();
            $planning = new Planning();
            $planning->name =  $request->name;
            $planning->description = $request->description;
            $planning->type = 'evaluation';
            $planning->user_id = $user->id;
            $planning->save();

            toastr()->success('Success', 'Operation reussie');
            return redirect()->route('eval')->with('success');
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

    // Fonction de creation d'une tache dans un planning de cours

    public function store_tache(Request $request, $id)
    {
        try {
            $plan = Todo_planning::where('planning_id', $id)->get();

            $tache = Todo::whereIn('id', $plan->pluck('todo_id'))
                ->where('heure_debut', '=', $request->heure_debut)
                ->where('heure_fin', '=', $request->heure_fin)
                ->where('jour', $request->jour)
                ->get();

            if ($tache->isNotEmpty()) {
                toastr()->error('Erreur', 'Marge horaire occupée');
                return redirect()->route('affiche_planning', $id);
            } else {
                if (empty($request->heure_debut) || empty($request->heure_fin)) {
                    toastr()->error('Erreur', 'Remplissez les champs requis');
                    return redirect()->route('affiche_planning', $id);
                } else {
                    $user = auth()->user();
                    $todo = new Todo();

                    $todo->name = $request->name;
                    $todo->description = $request->description;
                    $todo->date_debut = Carbon::now()->toDateString();
                    $todo->date_fin = '';
                    $todo->heure_debut = $request->heure_debut;
                    $todo->heure_fin = $request->heure_fin;
                    $todo->jour = $request->jour;
                    $todo->user_id = $user->id;


                    $liaison = new Todo_planning();
                    $salle = new Todo_salle();
                    $prof = new Todo_user();

                    if ($request->heure_debut >= $request->heure_fin) {
                        toastr()->error('Erreur', 'L\'heure de début doit être antérieure à l\'heure de fin');
                        return redirect()->route('affiche_planning', $id);
                    }
                    $todo->save();

                    $liaison->todo_id = $todo->id;
                    $liaison->planning_id = $id;
                    $liaison->save();

                    if ($request->salle != NULL) {
                        $salle->todo_id = $todo->id;
                        $salle->salle_id = $request->salle;
                        $salle->save();
                    }

                    if ($request->sub != NULL) {
                        $prof->todo_id = $todo->id;
                        $prof->user_id = $request->sub;
                        $prof->save();
                    }

                    toastr()->success('Success', 'Opération réussie');
                    return redirect()->route('affiche_planning', $id);
                }
            }
        } catch (\Exception $e) {
            // toastr()->error('Erreur', "Une erreur s'est produite");
            return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
        }
    }

    public function get_tache(Request $request, $id)
    {
        try {

            $user = auth()->user();
            $todo = Todo::find($id);
            return response()->json($todo);
        } catch (\Exception $e) {
            return response()->json('error');
        }
    }


    public function store_tache_eval(Request $request, $id)
    {
        $salle = Salle::where('name', $request->salle)->first();

        $ta = Todo::where('date_debut', '=', $request->date_debut)
            ->where('heure_debut', '=', $request->heure_debut)
            ->where('heure_fin', '=', $request->heure_fin)->get();

        if ($ta) {
            toastr()->error('Erreur', 'Date et horaire déjà utilisées pour une autre evaluation');
            return redirect()->route('affiche_eval', $id);
        }

        if ($request->heure_debut >= $request->heure_fin) {
            toastr()->error('Erreur', 'L\'heure de début doit être antérieure à l\'heure de fin');
            return redirect()->route('affiche_eval', $id);
        }

        $user = auth()->user();
        $todo = new Todo();

        $todo->name = $request->name;
        $todo->description = 'NULL';
        $todo->date_debut = $request->date_debut;
        $todo->date_fin = $request->date_debut;
        $todo->heure_debut = $request->heure_debut;
        $todo->heure_fin = $request->heure_fin;
        $todo->jour = 'NULL';
        $todo->user_id = $user->id;

        $liaison = new Todo_planning();

        $todo->save();

        $liaison->todo_id = $todo->id;
        $liaison->planning_id = $id;
        $liaison->save();

        $liaison_salle = new Todo_salle();

        $liaison_salle->todo_id = $todo->id;
        $liaison_salle->salle_id = $request->salle;
        $liaison_salle->save();

        $prof = new Todo_user();

        $prof->todo_id = $todo->id;
        $prof->user_id = $request->sub;
        $prof->save();


        toastr()->success('Success', 'Opération réussie');
        return redirect()->route('affiche_eval', $id);
    }


    public function plannings_eval()
    {
        $user = auth()->user();
        $planning = Planning::where('user_id', $user->id)
            ->where('type', 'evaluation')->get();
        return view('evaluation', compact('planning'));
    }

    public function destroy_planning($id)
    {
        try {
            $planning = Planning::find($id);

            if ($planning) {

                $todo = Todo_planning::where('planning_id', $id)->get();
                $todo_select_column = $todo->pluck('todo_id');

                Todo_user::whereIn('todo_id', $todo_select_column)->delete();
                Todo_planning::where('planning_id', $id)->delete();
                Todo_salle::whereIn('todo_id', $todo_select_column)->delete();

                $todo->each->delete();
                $planning->delete();
                return response()->json('ok');
            } else {
                return response()->json('off');
            }
        } catch (\Exception $e) {
            return response()->json('off');
        }
    }

    public function duplique_tache(Request $request, $id)
    {
        try {

            $plan = Todo_planning::where('todo_id', $id)->first();

            // Vérifiez si une tâche existe déjà avec les mêmes horaires et le même jour
            $existingTask = Todo::where('id', '!=', $id)
                ->where('heure_debut', $request->heure_debutduplique)
                ->where('heure_fin', $request->heure_finduplique)
                ->where('jour', $request->jourduplique)
                ->exists();

            if ($existingTask) {
                toastr()->error('Erreur', 'Marge horaire occupée');
                return redirect()->back();
            } else {
                // Validation des champs requis
                $request->validate([
                    'heure_debutduplique' => 'required',
                    'heure_finduplique' => 'required',
                    'jourduplique' => 'required',
                ]);

                $user = auth()->user();
                $todo_init = Todo::find($id);

                // Créez une nouvelle tâche basée sur les données de la tâche initiale
                $todo = new Todo();
                $todo->name = $todo_init->name;
                $todo->description = $todo_init->description;
                $todo->date_debut = $todo_init->date_debut;
                $todo->date_fin = $todo_init->date_debut; // Est-ce que c'est correct ?
                $todo->heure_debut = $request->heure_debutduplique;
                $todo->heure_fin = $request->heure_finduplique;
                $todo->jour = $request->jourduplique;
                $todo->user_id = $user->id;
                $todo->save();

                // Créez une liaison avec le planning
                $liaison = new Todo_planning();
                $liaison->todo_id = $todo->id;
                $liaison->planning_id = $plan->planning_id;
                $liaison->save();

                // Dupliquez la salle et le professeur associés à la tâche initiale
                $salle_init = Todo_salle::where('todo_id', $todo_init->id)->first();
                if ($salle_init) {
                    $salle = new Todo_salle();
                    $salle->todo_id = $todo->id;
                    $salle->salle_id = $salle_init->salle_id;
                    $salle->save();
                }

                $prof_init = Todo_user::where('todo_id', $todo_init->id)->first();
                if ($prof_init) {
                    $prof = new Todo_user();
                    $prof->todo_id = $todo->id;
                    $prof->user_id = $prof_init->user_id;
                    $prof->save();
                }

                toastr()->success('Success', 'Opération réussie');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
        }
    }


    // modification d'une tache dans un planning

    public function edit_tache(Request $request, $id)
    {
        try {

            $tache = Todo::where('id', '!=', $id)
                ->where('heure_debut', $request->heure_debutmodif)
                ->where('heure_fin', $request->heure_finmodif)
                ->where('jour', $request->jourmodif)
                ->exists();


            if ($tache) {
                toastr()->error('Erreur', 'Marge horaire occupée');
                return redirect()->back();
            } else {
                if (empty($request->heure_debutmodif) || empty($request->heure_finmodif)) {
                    toastr()->error('Erreur', 'Remplissez les champs requis');
                    return redirect()->back();
                } else {
                    $user = auth()->user();
                    $todo = Todo::find($id);

                    $todo->name = $request->namemodif;
                    $todo->description = $request->descriptionmodif;
                    $todo->date_debut = Carbon::now()->toDateString();
                    $todo->date_fin = Carbon::now()->toDateString();
                    $todo->heure_debut = $request->heure_debutmodif;
                    $todo->heure_fin = $request->heure_finmodif;
                    $todo->jour = $request->jourmodif;
                    $todo->user_id = $user->id;

                    $salle = Todo_salle::where('todo_id', $todo->id)->first();
                    $prof = Todo_user::where('todo_id', $todo->id)->first();

                    if ($request->heure_debutmodif >= $request->heure_finmodif) {
                        toastr()->error('Erreur', 'L\'heure de début doit être antérieure à l\'heure de fin');
                        return redirect()->back();
                    }
                    $todo->save();

                    if ($salle && $request->sallemodif != NULL) {
                        $salle->salle_id = $request->sallemodif;
                        $salle->save();
                    } elseif ($request->sallemodif) {
                        $salle = new Todo_salle();
                        $salle->todo_id = $todo->id;
                        $salle->salle_id = $request->sallemodif;
                        $salle->save();
                    }

                    if ($prof && $request->submodif != NULL) {
                        $prof->user_id = $request->submodif;
                        $prof->save();
                    } elseif ($request->submodif) {
                        $prof = new Todo_user();
                        $prof->todo_id = $todo->id;
                        $prof->user_id = $request->submodif;
                        $prof->save();
                    }

                    toastr()->success('Success', 'Opération réussie');
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
        }
    }

    public function myPlanning()
    {
        $user = auth()->user();
        $tod = Todo_user::where('user_id', $user->id)->get();
        $var = $tod->pluck('todo_id');
        $task = Todo::whereIn('id', $var)
            ->where('jour', '!=', '')->get();

        $salle = Salle::all();
        // $planning = Planning::find($id);

        return view('myPlanning', compact('task','salle'));
    }
}

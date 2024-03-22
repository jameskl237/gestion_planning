<?php

namespace App\Http\Controllers;

use App\Models\Planning;
use App\Models\Todo;
use App\Models\Todo_planning;
use App\Models\Todo_salle;
use App\Models\Salle;
use App\Models\Todo_user;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
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

        $to_sal = Todo_salle::whereIn('todo_id', $var)->get();
        $sa = $to_sal->pluck('salle_id');
        $sal = Salle::WhereIn('id', $sa)->get();

        $salle = Salle::all();

        return view('affiche_planning', compact('id', 'task', 'salle', 'sal'));
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

        return view('affiche_eval', compact('id', 'ta', 'salle', 'sal', 'i'));
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

            toastr()->success('Successs', 'Operation reussie');
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

            toastr()->success('Successs', 'Operation reussie');
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
                if (empty($request->name) || empty($request->date_debut) || empty($request->heure_debut) || empty($request->heure_fin)) {
                    toastr()->error('Erreur', 'Remplissez les champs requis');
                    return redirect()->route('affiche_planning', $id);
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

                    $liaison = new Todo_planning();
                    $salle = new Todo_salle();

                    if ($request->heure_debut >= $request->heure_fin) {
                        toastr()->error('Erreur', 'L\'heure de début doit être antérieure à l\'heure de fin');
                        return redirect()->route('affiche_planning', $id);
                    }
                    $todo->save();

                    $liaison->todo_id = $todo->id;
                    $liaison->planning_id = $id;
                    $liaison->save();

                    $salle->todo_id = $todo->id;
                    $salle->salle_id = $request->salle;
                    $salle->save();

                    toastr()->success('Succès', 'Opération réussie');
                    return redirect()->route('affiche_planning', $id);
                }
            }
        } catch (\Exception $e) {
            // toastr()->error('Erreur', "Une erreur s'est produite");
            return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
        }
    }

    // public function store_tache_eval(Request $request, $id)
    // {
    //     $tache = Todo::all();
    //     foreach ($tache as $ta) {
    //         if ($ta->heure_debut === $request->heure_debut || $ta->heure_fin === $request->heure_fin || $ta->date_debut === $request->date_debut) {
    //             dd('erreur');
    //             toastr()->success('erreur', 'heure deja choisie');
    //         } else {
    //             $user = auth()->user();
    //             $todo = new Todo();

    //             $todo->name = $request->name;
    //             $todo->description = 'NULL';
    //             $todo->date_debut = $request->date_debut;
    //             $todo->date_fin = $request->date_debut;
    //             $todo->heure_debut = $request->heure_debut;
    //             $todo->heure_fin = $request->heure_fin;
    //             $todo->jour = 'NULL';
    //             $todo->user_id = $user->id;

    //             $liaison = new Todo_planning();
    //             $salle = new Todo_salle();

    //             if ($todo->heure_debut > $todo->heure_fin) {
    //                 toastr()->error('erreur', 'Conflit horaire');
    //                 return redirect()->route('affiche_eval', $id);
    //             } else {
    //                 $todo->save();

    //                 $liaison->todo_id = $todo->id;
    //                 $liaison->planning_id = $id;
    //                 $liaison->save();


    //                 $salle->todo_id = $todo->id;
    //                 $salle->salle_id = $request->salle;
    //                 $salle->save();

    //                 toastr()->success('Successs', 'Operation reussie');
    //                 return redirect()->route('affiche_eval', $id);
    //             }
    //         }
    //     }
    // }

    public function store_tache_eval(Request $request, $id)
    {
        $salle = Salle::where('name', $request->salle)->first();

        // if (!$salle) {
        //     toastr()->error('Erreur', 'Salle non trouvée');
        //     return redirect()->route('affiche_eval', $id);
        // }

        $ta = Todo::where('date_debut', '=', $request->date_debut)
            ->where('heure_debut', '=', $request->heure_debut)
            ->where('heure_fin', '=', $request->heure_fin)->get();

        if ($ta->isNotEmpty()) {
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

        $salle->todo_id = $todo->id;
        $salle->salle_id = $request->salle;
        $salle->save();

        // $todo->salles()->attach($salle->id);

        toastr()->success('Succès', 'Opération réussie');
        return redirect()->route('affiche_eval', $id);
    }


    public function plannings_eval()
    {
        $user = auth()->user();
        $planning = Planning::where('user_id', $user->id)
            ->where('type', 'evaluation')->get();
        return view('evaluation', compact('planning'));
    }
}

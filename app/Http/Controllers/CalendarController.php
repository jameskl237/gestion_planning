<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Todo_user;


class CalendarController extends Controller
{
    public function calendar()
    {
        $user = auth()->user();
        $us = Todo_user::where('user_id', $user->id)->get();
        $var = $us->pluck('todo_id');
        $arr = Todo::whereIn('id', $var)->get();
        return view('calendar', compact('arr'));
    }

    public function index()
    {
        $user = auth()->user();
        $us = Todo_user::where('user_id', $user->id)->get();
        $var = $us->pluck('todo_id');
        $arr = Todo::whereIn('id', $var)->get();
        $events = [];

        foreach ($arr as $task) {
            $startDateTime = $task->date_debut . 'T' . $task->heure_debut; // Format de date/heure pour Otika : YYYY-MM-DDTHH:mm
            $endDateTime = $task->date_fin . 'T' . $task->heure_fin;

            $events[] = [
                'title' => $task->name,
                'start' => $startDateTime,
                'end' => $endDateTime,
            ];
        }

        return response()->json($events);
    }
}

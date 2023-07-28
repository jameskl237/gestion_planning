<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr = Todo::get();
        return response()->json([
            $arr
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = validator::make($request->all(),[
            'name'=>'required',
            'user_id'=>'require'
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $todo= Todo::create($request->all());
        return response()->json([
            'new todo'=>$todo,
            'message'=>'tache creee avec succes'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);
        return response()->json(
           $todo
           ,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $todo = Todo::find($id);
        if (is_null($todo)) {
            return response()->json([
                'message'=>'tag not found'
            ],404);
        }
        $todo->update($request->all());
        return response()->json([
            'tag'=>$todo,
            'message'=>'tag update succesfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $todo = Todo::find($id);
        if (is_null($todo)) {
            return response()->json([
                'message'=>'tag not found'
            ],404);
        }
        $tod = $todo;
        $todo->delete();
        return response()->json([
            'todo'=>$tod,
            'message'=>'tache supprimee'
        ]);
    }
}

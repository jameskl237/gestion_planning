<?php

namespace App\Http\Controllers;

use App\Http\Requests\createtodo;
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
        // $user = auth()->user();
        // dd($user);
        // $arr = Todo::where('user_id',$user->id)->get();
        // $tab = Todo::all(['name']);
        // // dd($tab);
        
        $arr = Todo::get();
        return view('welcome', compact('arr'));

    }

    public function indexapi(Request $request)
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
        return view('todocreate');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createtodo $request)
    {
        $todo = Todo::create([
            'name'=> $request->input('name'),
            'description'=> $request->input('description'),
            'user_id'=> 1
        ]);
        return redirect()->route('welcome')->with('success','Todo successfully saved');
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
    public function edit(Todo $todo)
    {
        return view('edittodo',[
            'todo'=>$todo
        ]);
    }

    public function update(createtodo $request,Todo $todo){
        $todo->update($request->validated());
        return redirect()->route('welcome')->with('success','Todo successfully edited');
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

     public function destroy_web($id)
     {
         $todo = Todo::find($id);
         if (is_null($todo)) {
             return back()->with('error', 'Todo not found');
         }

         $todo->delete();
         return redirect()->route('welcome')->with('success', 'Todo deleted successfully');
     }

    public function info(Todo $todo)
    {
        return view('info',[
            'todo'=>$todo
        ]);
    }

    public function find ($id){
        $todo = Todo::findOrFail($id);

    }

    public function pagina ($id){
        $todo = Todo::paginate($id,['name','description']);

    }

    // API FUNCTIONS

    public function destroy_api($id)
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

    public function update_api(Request $request,$id)
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

    public function store_api(Request $request)
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

    public function show_api($id)
    {
        $todo = Todo::find($id);
        return response()->json(
           $todo
           ,200);
    }

}

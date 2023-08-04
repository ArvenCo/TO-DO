<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $todo = Todo::orderBy('level', 'asc')->get();
        return response()->json($todo);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $todo = new Todo;
        $id = $request->id;
        $count = Todo::where("user_id", "=", $id)->count();

        $todo->name = $request->name;
        $todo->desc = $request->desc;
        $todo->user_id = $id;
        $todo->level = $count + 1;
        $saved = $todo->save();

        if ($saved) {
            return response()->json(["message" => "Saved Successfully "], 201);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //




    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //

        $type = $request->type;
        switch ($type) {
            case 'sort':
                # code...
                $id = $request->input('id');
                $level = $request->input('level');
                // dd([$id, $level]);
                foreach ($id as $key => $value) {
                    # code...

                    $todo = Todo::find($value);
                    $todo->level = $level[$key];
                    $todo->save();
                }
                return response()->json(["message" => "Sort Successful"]);

            case 'done':
                $id = $request->id;
                $todo = Todo::find($id);
                $todo->status = 1;
                $todo->level = 0;
                $todo->save();
                break;

            case 'undone':
                $id = $request->id;
                $todo = Todo::find($id);
                $todo->status = 2;
                $todo->level = 1;
                $todo->save();
                break;
            default:
                # code...


                break;
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $todo = Todo::find($request->id);
        $todo->delete();


    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Stack;
use Illuminate\Http\Request;

class StackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stacks = Stack::all();
        return response()->json(["stacks"=> $stacks]);
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
        $this->validate($request, [
            "name" => "required|string",
            "image" => "required|string"
        ]);
        $stack = new Stack();
        $stack->name = $request->name;
        $stack->image = $request->image;
        $stack->save();
        return response()->json([$stack]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stack  $stack
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stack = Stack::where('id', $id)->get();
        if(count($stack) < 1){
            return response()->json(["error" => "Stack no existe"]);
        }
        return response($stack);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stack  $stack
     * @return \Illuminate\Http\Response
     */
    public function edit(Stack $stack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stack  $stack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "name" => "required|string",
            "image" => "required|string"
        ]);
        $stack = Stack::where('id', $id)->first();
        $stack->name = $request->name;
        $stack->image = $request->image;
        $stack->save();
        return response()->json([$stack]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stack  $stack
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stack = Stack::where('id', $id)->first();
        if(!$stack){
            return response()->json(["error" => "Stack no existe"]);
        }
        $stack->delete();

         return response()->json(["data" => "Stack con id $id eliminado con éxito"]);
    }
}

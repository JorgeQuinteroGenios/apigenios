<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $developers = Developer::all();
        return response()->json(["developers"=> $developers]);
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
            "description" => "required|string",
            "image" => "required|string"
        ]);
        $developer = new Developer();
        $developer->name = $request->name;
        $developer->description = $request->description;
        $developer->image = $request->image;
        $developer->save();
        return response()->json([$developer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $developer = Developer::where('id', $id)->get();
        if(count($developer) < 1){
            return response()->json(["error" => "Desarrollador no existe"]);
        }
        return response($developer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function edit(Developer $developer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "name" => "required|string",
            "description" => "required|string",
            "image" => "required|string"
        ]);
        $developer = Developer::where('id', $id)->first();
        $developer->name = $request->name;
        $developer->description = $request->description;
        $developer->image = $request->image;
        $developer->save();
        return response()->json([$developer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $developer = Developer::where('id', $id)->first();
        if(!$developer){
            return response()->json(["error" => "Desarrollador no existe"]);
        }
        $developer->delete();

         return response()->json(["data" => "Desarrollador con id $id eliminado con éxito"]);
    }
}

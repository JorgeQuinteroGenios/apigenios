<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return response()->json(["services"=> $services]);
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
        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->image = $request->image;
        $service->save();
        return response()->json([$service]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = service::where('id', $id)->get();
        if(count($service) < 1){
            return response()->json(["error" => "Servicio no existe"]);
        }
        return response($service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "name" => "required|string",
            "description" => "required|string",
            "image" => "required|string"
        ]);
        $service = Service::where('id', $id)->first();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->image = $request->image;
        $service->save();
        return response()->json([$service]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::where('id', $id)->first();
        if(!$service){
            return response()->json(["error" => "Servicio no existe"]);
        }
        $service->delete();

         return response()->json(["data" => "Servicio con id $id eliminado con éxito"]);
    }
}

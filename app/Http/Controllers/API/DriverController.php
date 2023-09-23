<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Driver::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $driver = new Driver();
        $driver->id = $request->id;
        $driver->nombre = strtoupper($request->nombre);
        $driver->apellido = strtoupper($request->apellido);
        $driver->telefono = $request->telefono;
        $driver->licencia = $request->licencia;
        $driver->estado = $request->estado;
        $driver->razon_estado = $request->razon_estado;
        $driver->save();
        return $driver;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Driver::find($id);
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
        $driver = Driver::findOrFail($id);
        $driver->id = $request->id;
        $driver->nombre = strtoupper($request->nombre);
        $driver->apellido = strtoupper($request->apellido);
        $driver->telefono = $request->telefono;
        $driver->licencia = $request->licencia;
        $driver->estado = $request->estado;
        $driver->razon_estado = $request->razon_estado;
        $driver->save();
        return $driver;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Driver::destroy($id);
    }

    public function filter(Request $request)
    {
        $drivers = Driver::id($request->id)
            ->nombre($request->nombre)
            ->apellido($request->apellido)
            ->paginate(50);
        return $drivers;
    }
}

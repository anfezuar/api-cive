<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vehicle::paginate(50);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = new Vehicle();
        $vehicle->id = $request->id;
        $vehicle->placa = strtoupper($request->placa);
        $vehicle->marca = strtoupper($request->marca);
        $vehicle->modelo = $request->modelo;
        $vehicle->pasajeros = $request->pasajeros;
        $vehicle->vencimiento_soat = $request->vencimiento_soat;
        $vehicle->vencimiento_tec_mec = $request->vencimiento_tec_mec;
        $vehicle->vencimiento_todo_riesgo = $request->vencimiento_todo_riesgo;
        $vehicle->vencimiento_tarjeta_operacion = $request->vencimiento_tarjeta_operacion;
        $vehicle->estado = strtoupper($request->estado);
        $vehicle->razon_estado = $request->razon_estado;

        $vehicle->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Vehicle::find($id);
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
        $vehicle = Vehicle::findOrFail($request->id);
        $vehicle->placa = strtoupper($request->placa);
        $vehicle->marca = strtoupper($request->marca);
        $vehicle->modelo = $request->modelo;
        $vehicle->pasajeros = $request->pasajeros;
        $vehicle->vencimiento_soat = $request->vencimiento_soat;
        $vehicle->vencimiento_tec_mec = $request->vencimiento_tec_mec;
        $vehicle->vencimiento_todo_riesgo = $request->vencimiento_todo_riesgo;
        $vehicle->vencimiento_tarjeta_operacion = $request->vencimiento_tarjeta_operacion;
        $vehicle->estado = strtoupper($request->estado);
        $vehicle->razon_estado = strtoupper($request->estado) === "ACTIVO" ? "" : $request->razon_estado;

        $vehicle->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vehicle::destroy($id);
    }

    public function inactive()
    {
        $result = DB::table('vehicles')
        ->where('vencimiento_soat', '<', date('Y-m-d'))
        ->orWhere('vencimiento_tec_mec', '<', date('Y-m-d'))
        ->orWhere('vencimiento_todo_riesgo', '<', date('Y-m-d'))
        ->orWhere('vencimiento_tarjeta_operacion', '<', date('Y-m-d'))
        ->update(['estado' => 'INACTIVO', 'razon_estado' => 'Documentos vencidos']);
        return $result;
    }

    public function filter(Request $request)
    {
        $vehicles = Vehicle::id($request->id)
            ->placa($request->placa)
            ->paginate(50);
        return $vehicles;
    }
}

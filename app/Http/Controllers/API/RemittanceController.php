<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Remittance;
use Illuminate\Http\Request;

class RemittanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Remittance::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $remittance = new Remittance();
        $remittance->origen = strtoupper($request->origen);
        $remittance->destino = strtoupper($request->destino);
        $remittance->valor = $request->valor;
        $remittance->cedula_destinatario = $request->cedula_destinatario;
        $remittance->direccion_destinatario = $request->direccion_destinatario;
        $remittance->cedula_remitente = $request->cedula_remitente;
        $remittance->direccion_remitente = $request->direccion_remitente;
        $remittance->contenido = $request->contenido;
        $remittance->usuario = $request->usuario;
        $remittance->puerta = $request->puerta;
        $remittance->vehiculo = $request->vehiculo;

        $remittance->save();

        $remittance->customerDestinatario;
        $remittance->customerRemitente;
        $remittance->vehicle;
        return $remittance;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $remittance = Remittance::find($id);
       $remittance->customerDestinatario;
       $remittance->customerRemitente;
       $remittance->vehicle;
       return $remittance;
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
        $remittance = Remittance::findOrFail($id);
        $remittance->estado = 'ANULADA';
        $remittance->valor = 0;

        $remittance->save();
    }

    public function filter(Request $request)
    {
        $remittances = Remittance::id($request->id)
            ->destinatario($request->cedula_destinatario)
            ->remitente($request->cedula_remitente)
            ->usuario($request->usuario)
            ->origen($request->origen)
            ->destino($request->destino)
            ->created($request->created_ini, $request->created_fin)
            ->orderBy('id', 'desc')
            ->paginate(50);
        foreach($remittances as $remittance){
            $remittance->customerDestinatario;
            $remittance->customerRemitente;
            $remittance->vehicle;
        }
        return $remittances;
    }
}

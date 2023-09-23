<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketSpreadsheet;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        foreach($tickets as $ticket){
            $ticket->customer;
        }
        return $tickets;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = new Ticket();
        $ticket->fecha = $request->fecha;
        $ticket->cliente = $request->cliente;
        $ticket->origen = $request->origen;
        $ticket->destino = $request->destino;
        $ticket->observaciones = $request->observaciones;
        $ticket->usuario = $request->usuario;
        $ticket->puestos = $request->puestos;
        $ticket->precio = $request->precio;

        $ticket->save();
        $ticket->customer;

        return $ticket;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        $ticket->customer;
        return $ticket;
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
        $ticket = Ticket::findOrFail($id);
        $ticket->fecha = $request->fecha;
        $ticket->hora = $request->hora;
        $ticket->cliente = $request->cliente;
        $ticket->origen = $request->origen;
        $ticket->destino = $request->destino;
        $ticket->observaciones = $request->observaciones;
        $ticket->usuario = $request->usuario;
        $ticket->puestos = $request->puestos;
        $ticket->precio = $request->precio;

        $ticket->save();
    }

    public function updateEstado($id, $estado)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->estado = $estado;

        $ticket->save();
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->estado = 'ANULADO';
        $ticket->precio = 0;

        $ticket->save();

        TicketSpreadsheet::where('id_ticket', $ticket->id)->delete();

    }

    public function filter(Request $request)
    {
        $tickets = Ticket::id($request->id)
            ->fecha($request->fecha_ini, $request->fecha_fin)
            ->cliente($request->cliente)
            ->usuario($request->usuario)
            ->origen($request->origen)
            ->destino($request->destino)
            ->estado($request->estado)
            ->created($request->created_ini, $request->created_fin)
            ->orderBy('id', 'desc')
            ->paginate(50);
        foreach($tickets as $ticket){
            $ticket->customer;
        }
        return $tickets;
    }
}

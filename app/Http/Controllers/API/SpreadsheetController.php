<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Spreadsheet;
use App\Models\Ticket;
use App\Models\TicketSpreadsheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpreadsheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spreadsheets = Spreadsheet::all();
        foreach ($spreadsheets as $spreadsheet) {
            $spreadsheet->ticketsSpreadsheet;
            $spreadsheet->driver;
            $spreadsheet->vehicle;
        }

        return $spreadsheets;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = DB::transaction(function () use ($request) {
            $spreadsheet = new Spreadsheet();
            $spreadsheet->vehiculo = $request->vehiculo;
            $spreadsheet->conductor = $request->conductor;
            $spreadsheet->origen = $request->origen;
            $spreadsheet->destino = $request->destino;
            $spreadsheet->usuario = auth()->user()->name;
            $spreadsheet->updated_by = auth()->user()->name;

            $spreadsheet->save();
            $spreadsheet->driver;
            $spreadsheet->vehicle;

            foreach ($request->tickets as $ticket) {
                $ticketsSpreadsheet = new TicketSpreadsheet();
                $ticketsSpreadsheet->id_spreadsheet = $spreadsheet->id;
                $ticketsSpreadsheet->id_ticket = $ticket["id"];

                $ticketsSpreadsheet->save();

                $updateTicket = new TicketController();
                $updateTicket->updateEstado($ticket["id"], "DESPACHADO");
            }
            $spreadsheet->ticketsSpreadsheet;
            foreach ($spreadsheet->ticketsSpreadsheet as $ticketSpreadsheet) {
                $ticketSpreadsheet->ticket->customer;
            }
            return $spreadsheet;
        });
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $spreadsheet = Spreadsheet::findOrFail($id);
        if ($spreadsheet->estado !== 'ANULADA') {
            $spreadsheet->estado = 'ANULADA';
            $spreadsheet->updated_by = auth()->user()->name;

            if ($spreadsheet->save()) {
                $ticketsSpreadsheet = DB::table('ticket_spreadsheets')->where('id_spreadsheet', $spreadsheet->id)->get();
                foreach ($ticketsSpreadsheet as $ticketSpreadsheet) {
                    $ticket = Ticket::findOrFail($ticketSpreadsheet->id_ticket);
                    if ($ticket->estado === 'DESPACHADO') {
                        $ticket->estado = 'ACTIVO';
                        $ticket->save();
                    }
                }
            }
        }
    }

    public function filter(Request $request)
    {
        if ($request->ticket) {
            $spreadsheets = Spreadsheet::join("ticket_spreadsheets", "spreadsheets.id", "=", "ticket_spreadsheets.id_spreadsheet")
                ->where("ticket_spreadsheets.id_ticket", $request->ticket)
                ->paginate(50);
        } else {
            $spreadsheets = Spreadsheet::id($request->id)
                ->vehiculo($request->vehiculo)
                ->conductor($request->conductor)
                ->origen($request->origen)
                ->destino($request->destino)
                ->estado($request->estado)
                ->usuario($request->usuario)
                ->created($request->created_ini, $request->created_fin)
                ->orderBy('id', 'desc')
                ->paginate(50);
        }
        foreach ($spreadsheets as $spreadsheet) {
            $spreadsheet->ticketsSpreadsheet;
            foreach ($spreadsheet->ticketsSpreadsheet as $spreadsheetTicket) {
                $spreadsheetTicket->ticket->customer;
            }
            $spreadsheet->driver;
            $spreadsheet->vehicle;
        }
        return $spreadsheets;
    }
}

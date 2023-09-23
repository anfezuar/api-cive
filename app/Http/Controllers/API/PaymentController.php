<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymets = Payment::all();
        foreach($paymets as $payment){
            $payment->vehicle;
        }
        return $paymets;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        $payment = new Payment();
        $payment->vehiculo = $request->vehiculo;
        $payment->month = $request->month;
        $payment->year = $request->year;
        $payment->user = $request->user;

        $payment->save();

        DB::table('vehicles')
        ->where('id', '=', $payment->vehiculo)
        ->where('vencimiento_soat', '>', date('Y-m-d'))
        ->where('vencimiento_tec_mec', '>', date('Y-m-d'))
        ->where('vencimiento_todo_riesgo', '>', date('Y-m-d'))
        ->where('estado', '=', 'INACTIVO')
        ->update(['estado' => 'ACTIVO', 'razon_estado' => 'Pago del mes ' . $meses[$payment->month]]);
        
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
        //
    }

    public function filter(Request $request)
    {
        $payments = Payment::id($request->id)
            ->month($request->month)
            ->year($request->year)
            ->user($request->user)
            ->status($request->status)
            ->created($request->created_ini, $request->created_fin)
            ->orderBy('id', 'desc')
            ->paginate(50);
        foreach($payments as $payment){
            $payment->vehicle;
        }
        return $payments;
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();
        foreach($reviews as $review){
            $review->vehicle;
        }
        return $reviews;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $review = new Review();
        $review->vehiculo = $request->vehiculo;
        $review->estado = $request->estado;
        $review->descripcion = $request->descripcion;
        $review->usuario = $request->usuario;

        $review->save();

        
        if($request->estado === 'INACTIVO') {
            DB::table('vehicles')
            ->where('id', '=', $review->vehiculo)
            ->update(['estado' => $request->estado, 'razon_estado' => $review->descripcion]);
        } else {
            DB::table('vehicles')
            ->where('id', '=', $review->vehiculo)
            ->where('vencimiento_soat', '>', date('Y-m-d'))
            ->where('vencimiento_tec_mec', '>', date('Y-m-d'))
            ->where('vencimiento_todo_riesgo', '>', date('Y-m-d'))
            ->update(['estado' => 'ACTIVO', 'razon_estado' => $review->descripcion]);
        }

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
        $reviews = Review::id($request->id)
            ->usuario($request->usuario)
            ->estado($request->estado)
            ->created($request->created_ini, $request->created_fin)
            ->orderBy('id', 'desc')
            ->paginate(50);
        foreach($reviews as $review){
            $review->vehicle;
        }
        return $reviews;
    }
}

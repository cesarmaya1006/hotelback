<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidarHOtel;
use App\Models\Empresa\Habitacion;
use App\Models\Empresa\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['mensaje' => 'ok','hoteles'=>Hotel::with('acomodacion')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function guardar(ValidarHOtel $request)
    {
        $new_hotel = Hotel::create($request->all());

        return response()->json(['mensaje' => 'ok','hotel'=>$new_hotel]);
    }

    /**
     * Display the specified resource.
     */
    public function editar(string $id)
    {

        return response()->json(['mensaje' => 'ok','hotel'=>Hotel::with('acomodacion')->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function actualizar(Request $request, string $id)
    {
        return response()->json(['mensaje' => 'ok','hotel'=>Hotel::findOrFail($id)->update($request->all())]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function eliminar(string $id)
    {
        if (Hotel::destroy($id)) {
            return response()->json(['mensaje' => 'ok']);
        } else {
            return response()->json(['mensaje' => 'ng']);
        }
    }
    public function tipos($id){
        $hotel = Hotel::with('acomodacion')->findOrFail($id);
        $tipos = [];
        if ($hotel->acomodacion->count()>0) {
            if ($hotel->acomodacion->where('tipo','Estándar')->count()<2) {
                array_push($tipos,'Estándar');
            }
            if ($hotel->acomodacion->where('tipo','Junior')->count()<2) {
                array_push($tipos,'Junior');
            }
            if ($hotel->acomodacion->where('tipo','Suite')->count()<3) {
                array_push($tipos,'Suite');
            }
        }else{
            $tipos= ['Estándar','Junior','Suite'];
        }
        return response()->json([$tipos]);
    }

    public function acomodacionh($id,$acomodacion){
        $hotel = Hotel::with('acomodacion')->findOrFail($id);
        $acomodacion_array = [];
        //return response()->json([$hotel->acomodacion->where('tipo','Estándar')->count()]);
        if ($hotel->acomodacion->count()>0) {
            if ($hotel->acomodacion->where('tipo','Estándar')->count()<2 && $acomodacion =='Estándar') {
                if ($hotel->acomodacion->where('tipo','Estándar')->where('acomodacion','Sencilla')->count()<1) {
                    array_push($acomodacion_array,'Sencilla');
                }
                if ($hotel->acomodacion->where('tipo','Estándar')->where('acomodacion','Doble')->count()<1) {
                    array_push($acomodacion_array,'Doble');
                }
            }else if ($hotel->acomodacion->where('tipo','Junior')->count()<2 && $acomodacion =='Junior') {
                if ($hotel->acomodacion->where('tipo','Junior')->where('acomodacion','Triple')->count()<1) {
                    array_push($acomodacion_array,'Triple');
                }
                if ($hotel->acomodacion->where('tipo','Junior')->where('acomodacion','Cuádruple')->count()<1) {
                    array_push($acomodacion_array,'Cuádruple');
                }
            }else if ($hotel->acomodacion->where('tipo','Suite')->count()<3 && $acomodacion =='Suite') {
                if ($hotel->acomodacion->where('tipo','Suite')->where('acomodacion','Sencilla')->count()<1) {
                    array_push($acomodacion_array,'Sencilla');
                }
                if ($hotel->acomodacion->where('tipo','Suite')->where('acomodacion','Doble')->count()<1) {
                    array_push($acomodacion_array,'Doble');
                }
                if ($hotel->acomodacion->where('tipo','Suite')->where('acomodacion','Triple')->count()<1) {
                    array_push($acomodacion_array,'Triple');
                }
            }
        }else{
            switch ($acomodacion) {
                case 'Estándar':
                    array_push($acomodacion_array,'Sencilla');
                    array_push($acomodacion_array,'Doble');
                    break;

                case 'Junior':
                    array_push($acomodacion_array,'Triple');
                    array_push($acomodacion_array,'Cuádruple');
                    break;

                default:
                array_push($acomodacion_array,'Sencilla');
                array_push($acomodacion_array,'Doble');
                array_push($acomodacion_array,'Triple');
                break;
            }

        }
        return response()->json([$acomodacion_array]);
    }
    public function get_cantidad_f($id){
        $hotel = Hotel::with('acomodacion')->findOrFail($id);
        $cupoH = $hotel->habitaciones;
        $cupoUsado = $hotel->acomodacion->sum('cantidad');
        return ($cupoH-$cupoUsado);
    }
    public function acomodacionh_guardar(Request $request,$id){
        $new_acomodacion = Habitacion::create($request->all());

        return response()->json(['mensaje' => 'ok','hotel'=>$new_acomodacion]);
    }
    public function acomodacionh_eliminar($id){
        if (Habitacion::destroy($id)) {
            return response()->json(['mensaje' => 'ok']);
        } else {
            return response()->json(['mensaje' => 'ng']);
        }
    }
}

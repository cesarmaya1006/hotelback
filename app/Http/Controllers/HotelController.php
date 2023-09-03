<?php

namespace App\Http\Controllers;

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
    public function guardar(Request $request)
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
}

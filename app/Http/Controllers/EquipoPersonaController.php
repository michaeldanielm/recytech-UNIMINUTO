<?php

namespace App\Http\Controllers;

use App\EquipoPersona;
use Illuminate\Http\Request;
use DB;
class EquipoPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        try{
          DB::transaction(function() use($request){
            $relacion=new EquipoPersona();
            $relacion->id_equipo=$request->input('id_equipo');
            $relacion->id_persona=$request->input('id_persona');
            $relacion->save();
          });
          return response()->json(["ok"=>1]);
        }catch(\Exception $e){
          return response()->json(["error"=>$e]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EquipoPersona  $equipoPersona
     * @return \Illuminate\Http\Response
     */
    public function show(EquipoPersona $equipoPersona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EquipoPersona  $equipoPersona
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipoPersona $equipoPersona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EquipoPersona  $equipoPersona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipoPersona $equipoPersona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EquipoPersona  $equipoPersona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $relacion=EquipoPersona::find($request->input('id'));
      try{
        DB::transaction(function() use($relacion){
          $relacion->delete();
        });
        return response()->json([
          "ok"=>1
        ]);
      }catch(\Exception $e){
        return response()->json([
          "error"=>$e->getMessage()
        ]);
      }

    }
}

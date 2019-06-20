<?php

namespace App\Http\Controllers;

use App\ImpresoraUbicacion;
use App\ImpresoraCartucho;
use App\Impresora;
use App\Cartucho;
use App\Ubicacion;
use Illuminate\Http\Request;
use DB;
class ImpresoraUbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impresoras=ImpresoraUbicacion::with('impresora')
                                        ->with('ubicacion')
                                        ->with('impresoraCartucho')
                                              ->with('impresoraCartucho.cartucho')
                                        ->get();
        $listadoImpresoras=Impresora::all();
        $listadoToner=Cartucho::all();
        $ubicaciones=Ubicacion::all();
        // $impresorasCartuchos=ImpresoraCartucho::all();
        return view('admin.impresoras.lista',compact('impresoras','listadoImpresoras','listadoToner','ubicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $impresoraUbicacion=new ImpresoraUbicacion();
        try{
          DB::transaction(function() use($request, $impresoraUbicacion){
              $impresoraUbicacion->id_impresora=$request->input('id_impresora');
              $impresoraUbicacion->id_ubicacion=$request->input('id_ubicacion');
              $impresoraUbicacion->save();
          });
          return response()->json(["ok"=>1]);
        }catch(\Exception $e){
          return response()->json(["error"=>$e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImpresoraUbicacion  $impresoraUbicacion
     * @return \Illuminate\Http\Response
     */
    public function show(ImpresoraUbicacion $impresoraUbicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImpresoraUbicacion  $impresoraUbicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(ImpresoraUbicacion $impresoraUbicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImpresoraUbicacion  $impresoraUbicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImpresoraUbicacion $impresoraUbicacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImpresoraUbicacion  $impresoraUbicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $relacion=ImpresoraUbicacion::find($request->input('id'));
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

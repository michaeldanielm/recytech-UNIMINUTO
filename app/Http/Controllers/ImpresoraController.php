<?php

namespace App\Http\Controllers;

use App\Impresora;
use App\Cartucho;
use App\Ubicacion;
use App\ImpresoraUbicacion;
use App\ImpresoraCartucho;
use Illuminate\Http\Request;
use DB;
class ImpresoraController extends Controller
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
          $impresora=new Impresora();
          $impresora->modelo=$request->input('modelo');
          $impresora->save();
        });
        return response()->json(['ok'=>1]);
      }catch(\Exception $e){
        return response()->json(['error'=>$e]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Impresora  $impresora
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $impresora=ImpresoraUbicacion::where('id_impresora',$id);
        $impresora=Impresora::with('impresoraUbicacion')
                                ->with('impresoraUbicacion.ubicacion')
                              ->with('impresoraCartucho')
                                ->with('impresoraCartucho.cartucho')
                              ->where('id_impresora',$id)
                              ->get();
        $listadoImpresoras=Impresora::all();
        $listadoToner=Cartucho::all();
        $ubicaciones=Ubicacion::all();
        return view('admin.impresoras.verImpresora',compact('impresora','listadoImpresoras','listadoToner','ubicaciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Impresora  $impresora
     * @return \Illuminate\Http\Response
     */
    public function edit(Impresora $impresora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Impresora  $impresora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Impresora $impresora)
    {
      try{
        DB::transaction(function() use($request,$impresora){
          $impresora->modelo=$request->input('modelo');
          $impresora->save();
        });
        return response()->json(["ok"=>1]);
      }catch(\Exception $e){
        return response()->json(["error"=>$e->getMessage()]);
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Impresora  $impresora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Impresora $impresora)
    {
        //
    }
}

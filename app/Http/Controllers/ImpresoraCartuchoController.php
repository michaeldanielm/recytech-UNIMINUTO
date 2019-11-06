<?php

namespace App\Http\Controllers;

use App\ImpresoraCartucho;
use Illuminate\Http\Request;
use App\Impresora;
use App\Cartucho;
use DB;

class ImpresoraCartuchoController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
          DB::transaction(function() use ($request){
            $impresoraCartucho=new ImpresoraCartucho();
            $impresoraCartucho->id_impresora=$request->input('id_impresora');
            $impresoraCartucho->id_cartucho=$request->input('id_cartucho');
            $impresoraCartucho->save();
          });
          return response()->json(['ok'=>1]);
        }catch(\Exception $e){
          return response()->json(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImpresoraCartucho  $impresoraCartucho
     * @return \Illuminate\Http\Response
     */
    public function show(ImpresoraCartucho $impresoraCartucho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImpresoraCartucho  $impresoraCartucho
     * @return \Illuminate\Http\Response
     */
    public function edit(ImpresoraCartucho $impresoraCartucho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImpresoraCartucho  $impresoraCartucho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImpresoraCartucho $impresoraCartucho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImpresoraCartucho  $impresoraCartucho
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $relacion=ImpresoraCartucho::find($request->input('id'));
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

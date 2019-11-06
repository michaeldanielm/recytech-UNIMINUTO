<?php

namespace App\Http\Controllers;

use App\Cartucho;
use Illuminate\Http\Request;
use DB;
use App\RegistroConsumo;
use App\InventarioCartuchos;
class CartuchoController extends Controller
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
        DB::transaction(function() use($request){
          $cartucho=Cartucho::firstOrNew(['modelo' => $request->input('modelo')]);
          $inventario=new InventarioCartuchos();

          if(!$cartucho->exists){
            $cartucho->modelo=$request->input('modelo');
            $cartucho->save();
          }


          /* Se inserta el id del último cartucho creado o seleccionado */
          $inventario->id_cartucho=$cartucho->id_cartucho;
          $inventario->id_ubicacion= $request->input('id_ubicacion');

          $request->input('cantidad')>0 ? $inventario->cantidad=$request->input('cantidad') : $inventario->cantidad=0;
          $request->input('cantidadSugerida')>0 ? $inventario->cantidadSugerida=$request->input('cantidadSugerida') : $inventario->cantidadSugerida=0;

          $inventario->save();
        });
        return response()->json(['ok'=>1]);
      }catch(\Exception $e){
        return response()->json(['ok'=>0,'error'=>$e->getMessage()]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cartucho  $cartucho
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

    }

    public function infoCartucho(Request $request){
      $inventario=InventarioCartuchos::where('id_cartucho',$request->input('cartucho'))->get();
      return response()->json($inventario);
    }

    public function infoRelacion(Request $request){
      $inventario=InventarioCartuchos::where([
                                                ['id_cartucho',$request->input('id_cartucho')],
                                                ['id_ubicacion',$request->input('id_ubicacion')],
                                              ])->first();
      return response()->json($inventario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cartucho  $cartucho
     * @return \Illuminate\Http\Response
     */
    public function edit(Cartucho $cartucho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cartucho  $cartucho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      // $cartucho=Cartucho::find($request->input('id_cartucho'));
      $inventario=InventarioCartuchos::findOrFail($request->input('id_inventario'));

      $relacion=new RegistroConsumo();

      try{
        $cantidadActual=$inventario->cantidad;
        DB::transaction(function() use($request,$inventario){
          $inventario->cantidad = $request->input('cantidad');
          $inventario->cantidadSugerida = $request->input('cantidadSugerida');
          $inventario->save();
        });
        if(!is_null($request->input('id_relacion')) && $request->input('id_relacion')>=1){
          DB::transaction(function() use($request, $relacion, $inventario, $cantidadActual){
            $relacion->id_impresora_ubicacion = $request->input('id_relacion');
            $relacion->id_inventario_cartucho = $inventario->id;
            $relacion->cantidad = $cantidadActual - $request->input('cantidad');
            $relacion->save();
          });
        }
        return response()->json(["ok"=>1]);
      }catch(\Exception $e){
        return response()->json(["ok"=>0, "error"=>$e->getMessage()]);
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cartucho  $cartucho
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cartucho $cartucho)
    {
        //
    }
}

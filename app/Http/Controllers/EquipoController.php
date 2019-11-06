<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Persona;
use App\Ubicacion;
use DB;
use Illuminate\Http\Request;

class EquipoController extends Controller
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
      $equipos=Equipo::with('equipoPersona')
                      ->with('equipoPersona.persona')
                      ->with('equipoPersona.persona.ubicacion')
                      ->get();
      $personas=Persona::with('ubicacion')->get();
      $ubicaciones=Ubicacion::all();
      return view('admin.equipos.lista',compact('equipos','personas','ubicaciones'));
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
            Equipo::create($request->all());
          });
          return response()->json(["ok"=>1]);
        }catch(\Exception $e){
          return response()->json(["error"=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $equipo=Equipo::with('equipoPersona')
                      ->with('equipoPersona.persona')
                      ->with('equipoPersona.persona.ubicacion')
                      ->where('id_equipo',$id)
                      ->get();
      $personas=Persona::with('ubicacion')->get();
      return view('admin.equipos.verEquipo',compact('equipo','personas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(equipo $equipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, equipo $equipo)
    {
        try{
          DB::transaction(function() use($request,$equipo){
            $equipo->update($request->all());
          });
          return response()->json(["ok"=>1]);
        }catch(\Exception $e){
          return response()->json(["error"=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      try{
        DB::transaction(function() use($request){
          $equipo=Equipo::find($request->input('id'));
          $equipo->delete();
        });
        return response()->json(["ok"=>1]);
      }catch(\Exception $e){
        return response()->json(["error"=>$e->getMessage()]);
      }
    }

}

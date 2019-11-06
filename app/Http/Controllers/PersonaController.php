<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;
use DB;
use App\Ubicacion;
class PersonaController extends Controller
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
            Persona::create($request->all());
          });
          return response()->json(["ok"=>1]);
        }catch(\Exception $e){
          return response()->json(["error"=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona=Persona::find($id);
        $ubicaciones=Ubicacion::all();
        // return response()->json(["persona"=>$persona]);
        return view('admin.equipos.editarPersona',compact('persona','ubicaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $persona=Persona::find($id);
        try{
          DB::transaction(function() use($request,$persona){
            $persona->update($request->all());
          });
          return response()->json(["ok"=>1]);
        }catch(\Exception $e){
          return response()->json(["error"=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      try{
        DB::transaction(function() use($request){
          $persona=Persona::find($request->input('id'));
          $persona->delete();
        });
        return response()->json(["ok"=>1]);
      }catch(\Exception $e){
        return response()->json(["error"=>$e->getMessage()]);
      }
    }
}

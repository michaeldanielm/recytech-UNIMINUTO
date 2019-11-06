<?php

namespace App\Http\Controllers;

use App\Carpetas;
use Illuminate\Http\Request;

class CarpetasController extends Controller
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
        $carpetas=Carpetas::all();
        return view('admin.carpetas.inicio',compact('carpetas'));
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
            $c=new Carpetas();
            $c->create($request->all());
            return response()->json(["ok"=>1]);
        }catch(\Exception $e){
            return response()->json(["ok"=>0,"error"=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carpetas  $carpetas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carpeta=Carpetas::findOrFail($id);
        return view('admin.carpetas.ver',compact('carpeta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carpetas  $carpetas
     * @return \Illuminate\Http\Response
     */
    public function edit(Carpetas $carpetas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carpetas  $carpetas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $carpeta=Carpetas::findOrFail($id);
            $carpeta->update($request->all());
            return response()->json(["ok"=>1]);
        }catch(\Exception $e){
            return response()->json(["ok"=>0,"error"=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carpetas  $carpetas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $carpeta=Carpetas::findOrFail($id);
            $carpeta->delete();
            return response()->json(["ok"=>1]);
        }catch(\Exception $e){
            return response()->json(["ok"=>0,"error"=>$e->getMessage()]);
        }
    }
}

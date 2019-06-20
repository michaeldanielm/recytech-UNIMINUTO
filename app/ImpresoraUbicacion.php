<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImpresoraUbicacion extends Model
{
    protected $table="impresoras_ubicaciones";
    public $timestamps=false;

    public function impresora(){
      return $this->belongsTo('App\Impresora','id_impresora','id_impresora');
    }
    public function ubicacion(){
      return $this->belongsTo('App\Ubicacion','id_ubicacion','id_ubicacion');
    }
    public function impresoraCartucho(){
      return $this->hasMany('App\ImpresoraCartucho','id_impresora','id_impresora');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroConsumoToner extends Model
{
    public $timestamps=true;

    protected $guarded=["token"];

    public function impresoraUbicacion(){
      return $this->hasOne('App\ImpresoraUbicacion','id','id_impresora_ubicacion');
    }

    public function cartucho(){
      return $this->hasOne('App\Cartucho','id_cartucho','id_toner');
    }
}

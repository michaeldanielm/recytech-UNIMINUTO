<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Impresora extends Model
{
    protected $primaryKey = 'id_impresora';
    public $timestamps=false;

    public function impresoraCartucho(){
      return $this->hasMany('App\ImpresoraCartucho','id_impresora','id_impresora');
    }

    public function impresoraUbicacion(){
      return $this->hasMany('App\ImpresoraUbicacion','id_impresora','id_impresora');
    }
}

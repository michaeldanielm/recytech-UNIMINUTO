<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImpresoraCartucho extends Model
{
  protected $table="impresoras_cartuchos";
  public $timestamps=false;
  public function impresora(){
    return $this->belongsTo('App\Impresora','id_impresora','id_impresora');
  }
  public function cartucho(){
    return $this->belongsTo('App\Cartucho','id_cartucho','id_cartucho');
  }
}

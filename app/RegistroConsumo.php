<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroConsumo extends Model
{
    protected $table="registro_consumo";

    public function inventario(){
      return $this->belongsTo(InventarioCartuchos::class,'id_inventario_cartucho','id');
    }
    public function impresoraUbicacion(){
      return $this->belongsTo(ImpresoraUbicacion::class,'id_impresora_ubicacion','id');
    }
}

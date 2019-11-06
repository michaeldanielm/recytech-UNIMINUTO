<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventarioCartuchos extends Model
{
    public function cartucho(){
        return $this->hasOne('App\Cartucho','id_cartucho','id_cartucho');
    }
    public function ubicacion(){
        return $this->hasOne('App\Ubicacion','id_ubicacion','id_ubicacion');
    }

}

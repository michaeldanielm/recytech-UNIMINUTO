<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
      protected $primaryKey = 'id_persona';
      protected $guarded=['token'];
      public $timestamps=false;

      public function equipoPersona(){
        return $this->belongsToMany('App\EquipoPersona','id_persona','id_persona');
      }
      
      public function ubicacion(){
        return $this->hasOne('App\Ubicacion','id_ubicacion','id_ubicacion');
      }
}

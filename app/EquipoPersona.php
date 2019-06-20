<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipoPersona extends Model
{
  protected $table='equipos_personas';

  public function persona(){
    return $this->hasOne('App\Persona','id_persona','id_persona');
  }

  public function equipo(){
    return $this->hasOne('App\Equipo','id_equipo','id_equipo');
  }

}

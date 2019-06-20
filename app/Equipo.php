<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $primaryKey = 'id_equipo';

    protected $guarded=['token'];
    public function equipoPersona(){
      return $this->hasOne('App\EquipoPersona','id_equipo','id_equipo');
    }
}

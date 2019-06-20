<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
      protected $primaryKey = 'id_ubicacion';
      protected $table = 'ubicaciones';
      public $timestamps = false;
}

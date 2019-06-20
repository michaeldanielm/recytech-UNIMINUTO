<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkEquiposPersonas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipos_personas', function (Blueprint $table) {
          $table->foreign('id_equipo')
                  ->references('id_equipo')
                  ->on('equipos');
          $table->foreign('id_persona')
                  ->references('id_persona')
                  ->on('personas');        

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipos_personas', function (Blueprint $table) {
            //
        });
    }
}

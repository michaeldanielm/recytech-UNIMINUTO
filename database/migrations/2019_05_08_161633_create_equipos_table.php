<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->bigIncrements('id_equipo');
            $table->string('tipo',20);
            $table->string('marca',20)->nullable();
            $table->string('modelo',20)->nullable();
            $table->string('mac',100)->nullable();
            $table->string('ns',80)->nullable();
            $table->string('procesador',15)->nullable();
            $table->string('ram',15)->nullable();
            $table->string('disco_duro',15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipos');
    }
}

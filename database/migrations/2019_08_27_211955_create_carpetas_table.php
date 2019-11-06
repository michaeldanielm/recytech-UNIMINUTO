<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarpetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpetas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_carpeta');
            $table->string('ruta')->nullable();
            $table->string('usuario');
            $table->string('contrasena')->nullable();
            $table->string('solicitante')->nullable();
            $table->string('planta')->nullable();
            $table->string('departamento')->nullable();
            $table->string('acceso')->nullable();
            $table->string('solicitantes')->nullable();
            $table->string('permisos')->nullable();
            $table->boolean('papelera')->default(0);

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
        Schema::dropIfExists('carpetas');
    }
}

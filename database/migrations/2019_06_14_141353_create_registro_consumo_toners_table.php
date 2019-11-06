<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroConsumoTonersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_consumo_toners', function (Blueprint $table) {
            $table->bigIncrements('id');
            //Relación del modelo de impresora y ubicación
            $table->bigInteger('id_impresora_ubicacion')->unsigned();
            $table->bigInteger('id_toner')->unsigned();
            $table->bigInteger('cantidad');
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
        Schema::dropIfExists('registro_consumo_toners');
    }
}

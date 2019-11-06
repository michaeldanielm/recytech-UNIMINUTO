<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColumnaRelacionUbicacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registro_consumo', function (Blueprint $table) {
            $table->unsignedBigInteger('id_impresora_ubicacion');
            $table->foreign('id_impresora_ubicacion')->references('id')->on('impresoras_ubicaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registro_consumo', function (Blueprint $table) {
            //
        });
    }
}

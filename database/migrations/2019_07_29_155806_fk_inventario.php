<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkInventario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventario_cartuchos', function (Blueprint $table) {
            $table->foreign('id_cartucho')->references('id_cartucho')->on('cartuchos');
            $table->foreign('id_ubicacion')->references('id_ubicacion')->on('ubicaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventario_cartuchos', function (Blueprint $table) {
            //
        });
    }
}

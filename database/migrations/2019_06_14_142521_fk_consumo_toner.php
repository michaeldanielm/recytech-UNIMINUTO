<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkConsumoToner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registro_consumo_toners', function (Blueprint $table) {
            $table->foreign('id_impresora_ubicacion')
                            ->references('id')
                            ->on('impresoras_ubicaciones');
            $table->foreign('id_toner')
                            ->references('id_cartucho')
                            ->on('cartuchos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registro_consumo_toners', function (Blueprint $table) {
            //
        });
    }
}

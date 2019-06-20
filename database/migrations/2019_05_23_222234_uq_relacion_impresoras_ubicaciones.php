<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UqRelacionImpresorasUbicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('impresoras_ubicaciones', function (Blueprint $table) {
            $table->unique(['id_impresora','id_ubicacion']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('impresoras_ubicaciones', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UqRelacionImpresorasCartuchos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('impresoras_cartuchos', function (Blueprint $table) {
            $table->unique(['id_impresora','id_cartucho']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('impresoras_cartuchos', function (Blueprint $table) {
            //
        });
    }
}

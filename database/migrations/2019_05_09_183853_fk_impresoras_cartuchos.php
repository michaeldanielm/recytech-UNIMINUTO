<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkImpresorasCartuchos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('impresoras_cartuchos', function (Blueprint $table) {
          $table->foreign('id_impresora')
                  ->references('id_impresora')
                  ->on('impresoras');
          $table->foreign('id_cartucho')
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
        Schema::table('impresoras_cartuchos', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificarCartuchos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cartuchos', function (Blueprint $table) {
            $table->dropColumn('cantidad');
            $table->dropColumn('cantidadSugerida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cartuchos', function (Blueprint $table) {
            $table->addColumn('cantidad')->nullable();
            $table->addColumn('cantidadSugerida')->nullable();
        });
    }
}

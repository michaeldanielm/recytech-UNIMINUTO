<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarioCartuchosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_cartuchos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_cartucho')->unsigned();
            $table->bigInteger('id_ubicacion')->unsigned();
            $table->integer('cantidad')->default(0);
            $table->integer('cantidadSugerida')->default(0);
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
        Schema::dropIfExists('inventario_cartuchos');
    }
}

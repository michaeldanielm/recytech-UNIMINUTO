<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpresoraCartuchosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impresoras_cartuchos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_impresora')->unsigned();
            $table->bigInteger('id_cartucho')->unsigned();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('impresora_cartuchos');
    }
}

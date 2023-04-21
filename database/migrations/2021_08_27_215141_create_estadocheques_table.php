<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadochequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadocheques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->unsigned();  
                // 1 en cartera
                // 2 Depositado
                // 3 Pago a Tercero
                // 4 Rechazado
                // 5 Cambiado/Cobrado en Efectivo
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
        Schema::dropIfExists('estadocheques');
    }
}

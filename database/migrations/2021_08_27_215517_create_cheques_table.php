<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fch_emision');
            $table->date('fch_cobr');
            $table->decimal('importe', 8, 2);
            //Clave Foránea a la Tabla de Clientes
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('titular');
            //Clave Foránea a la Tabla de Bancos
            $table->integer('banco_id')->unsigned();
            $table->foreign('banco_id')->references('id')->on('bancos');
            $table->integer('number');
            $table->integer('estadocheque_id')->unsigned();
            $table->foreign('estadocheque_id')->references('id')->on('estadocheques');
            //Clave Foránea a la Tabla de Cajas
            $table->Integer('cajas_id')->unsigned()->nullable();
            $table->foreign('cajas_id')->references('id')->on('cajas');

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
        Schema::dropIfExists('cheques');
    }
}

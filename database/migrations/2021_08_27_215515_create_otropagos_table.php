<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtropagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otropagos', function (Blueprint $table) {
            $table->increments('id');
            //Clave Foránea a la Tabla de Cajas
            $table->Integer('cajas_id')->unsigned()->nullable();
            $table->foreign('cajas_id')->references('id')->on('cajas');

            //Clave Foránea a la Tabla de Clientes
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
            
            //Clave Foránea a la Tabla de Tipomovimientos
            $table->integer('tipomovimiento_id')->unsigned();
            $table->foreign('tipomovimiento_id')->references('id')->on('tipomovimientos');

            $table->string('detalle');
            $table->decimal('importe', 8, 2);
            
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
        Schema::dropIfExists('otropagos');
    }
}

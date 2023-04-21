<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            
            //Clave foránea a Punto de Ventas
            //San Martin, Independencia, Zona de Reparto2
            $table->Integer('puntodeventa_id')->unsigned();
            $table->foreign('puntodeventa_id')->references('id')->on('puntodeventas');

            //Clave Foránea a la Tabla de usuarios
            $table->Integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            //Clave Foránea a la Tabla de efectivos
            $table->Integer('efectivo_id')->unsigned()->nullable();
            $table->foreign('efectivo_id')->references('id')->on('efectivos');

            // Rendicion de Valores
            $table->decimal('totalplanilla', 8, 2);
            
            // Anotaciones
            $table->string('anotaciones')->nullable();

            $table->string('status')->nullable();   
            //Abierta - Cerrada - Controlada - Auditada

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
        Schema::dropIfExists('cajas');
    }
}

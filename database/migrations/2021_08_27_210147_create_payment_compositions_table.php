<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentCompositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_compositions', function (Blueprint $table) {
            $table->increments('id');
             //fk Invoice
             $table->integer('payment_id')->unsigned();
             $table->foreign('payment_id')->references('id')->on('payments');
             $table->string('description'); //Efectivo - Cheques - Tarjeta - Otros
             $table->float('amount')->nullable();
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
        Schema::dropIfExists('payment_compositions');
    }
}

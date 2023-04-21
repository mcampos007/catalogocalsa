<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('payment_date')->nullable();
            $table->float('total');
            $table->float('acuenta')->nullable();
             //FK a la Tabla Invoices
             $table->integer('invoice_id')->unsigned();
             $table->foreign('invoice_id')->references('id')->on('invoices');
            //FK a la Tabla Client
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');


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
        Schema::dropIfExists('payments');
    }
}

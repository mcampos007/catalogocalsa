<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            
            $table->date('invoice_date')->nullable();
            $table->date('accounting_date')->nullable();
            $table->string('status');   //Pending, Paid, Canelleds

            //FK a la Tabla Usuario
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            //FK a la Tabla Carts
            $table->integer('cart_id')->unsigned();
            $table->foreign('cart_id')->references('id')->on('carts');

            //FK a la Tabla Clients
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->float('total')->nullable(); //total del comprobante
            $table->float('acuenta')->nullable(); //Total de pagos realizados

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
        Schema::dropIfExists('invoices');
    }
}

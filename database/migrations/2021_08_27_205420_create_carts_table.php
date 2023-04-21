<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');

            $table->date('order_date')->nullable();
            $table->date('arrived_date')->nullable();
            $table->string('status');   //Active, Pending, Approved, Cancelled, En_Reparto Finished, Invoiced

            //FK
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            //fk
            $table->integer('client_id')->unsigned()->nullable();
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
        Schema::dropIfExists('carts');
    }
}

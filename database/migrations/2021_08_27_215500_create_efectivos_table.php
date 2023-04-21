<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEfectivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('efectivos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('billete1000')->nullable();
            $table->integer('billete500')->nullable();
            $table->integer('billete200')->nullable();
            $table->integer('billete100')->nullable();
            $table->integer('billete50')->nullable();
            $table->integer('billete20')->nullable();
            $table->integer('billete10')->nullable();

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
        Schema::dropIfExists('efectivos');
    }
}

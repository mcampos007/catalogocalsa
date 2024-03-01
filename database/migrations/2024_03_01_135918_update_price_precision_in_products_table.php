<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePricePrecisionInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price', 12, 4)->change();
            $table->decimal('con_descuento',12,4)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
         Schema::table('products', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->change();
            $table->decimal('con_descuento',10,2)->change();
        });
    }
}

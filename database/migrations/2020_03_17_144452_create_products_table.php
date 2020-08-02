<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->string('unique_code');
            $table->string('name');
            $table->integer('quantity')->default(0);
            $table->float('input_price')->default(0)->comment('nhap hang');
            $table->float('price')->default(0);
            $table->float('wholesale_price')->default(0)->comment('ban le');
            $table->float('retail_price')->default(0)->comment('ban si');
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
        Schema::dropIfExists('products');
    }
}

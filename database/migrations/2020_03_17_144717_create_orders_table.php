<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('client_id');
            $table->integer('quantity');
            $table->float('wholesale_price')->default(0)->comment('ban le');
            $table->float('retail_price')->default(0)->comment('ban si');
            $table->float('real_cost');
            $table->float('debt_in_scope')->comment('cong no trong 1 khoan thoi gian');
            $table->timestamps();

            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('customer_id')->index()->nullable();
            $table->unsignedInteger('cashier_id')->index()->nullable();
            
            $table->unsignedInteger('product_id')->index();
            $table->unsignedInteger('order_status_id')->default(0);

            $table->decimal('overall_percent_discount', 5, 2)->index()->default(0); //90000.00
            $table->decimal('total_price', 7, 2)->index(); //90000.00
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
        Schema::dropIfExists('orders');
    }
}

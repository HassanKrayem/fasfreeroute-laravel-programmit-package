<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id')->index()->nullable();
            $table->unsignedInteger('product_id')->index();
            $table->string('product_label');
            $table->integer('quantity');
            $table->decimal('product_sell_price', 22, 2)->index();
            $table->decimal('net_total', 22, 2)->index(); //90000.00
            // $table->text('description'); // brand + any deitals 
            // $table->decimal('vat_percent', 5, 2)->index()->default(0); //90000.00
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
        Schema::dropIfExists('invoice_lines');
    }
}

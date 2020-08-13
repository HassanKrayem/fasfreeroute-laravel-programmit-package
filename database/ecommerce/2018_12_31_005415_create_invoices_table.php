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
            $table->unsignedInteger('cashier_id')->index();
            $table->unsignedInteger('invoice_status_id')->default(0);
            $table->unsignedInteger('invoice_type_id');
            $table->unsignedInteger('customer_id')->index()->nullable();

            $table->decimal('total', 22, 2)->index(); //90000.00
            $table->decimal('percent_discount', 22, 2)->index()->default(0); //90000.00
            $table->decimal('tax_percent', 22, 2)->index()->default(0); //90000.00
            $table->decimal('net_total', 22, 2)->index(); //90000.00
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

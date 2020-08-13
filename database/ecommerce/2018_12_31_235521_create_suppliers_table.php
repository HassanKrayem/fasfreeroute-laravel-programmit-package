<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('info_email')->nullable();
            $table->string('sales_email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('reception_phone');
            $table->string('sales_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->json('industry_fields')->nullable(); // electroic, audios etc.. array of majors the supplier deals with.
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
        Schema::dropIfExists('suppliers');
    }
}

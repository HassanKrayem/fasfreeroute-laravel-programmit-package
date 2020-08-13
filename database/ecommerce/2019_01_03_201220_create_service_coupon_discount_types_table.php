<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCouponDiscountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_coupon_discount_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('description')->nullable();
            $table->timestamps();
        });

         $data = array(
            array('label' => 'Amount', 'description' => ''),
            array('label' => 'Percent', 'description' => ''),
        );

        \App\ServiceCouponDiscountType::insert($data); // Eloquent approach
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_coupon_discount_types');
    }
}

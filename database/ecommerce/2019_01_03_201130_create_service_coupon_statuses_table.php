<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCouponStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_coupon_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('css_background_color',20)->nullable();
            $table->string('css_text_color',20)->nullable();
            $table->string('css_style',20)->nullable();
            $table->string('css_class')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

         $data = array(
            array('label' => 'Active', 'description' => 'Coupon is ready to be consumed.'),
            array('label' => 'Consumed', 'description' => 'Coupon has been consumed'),
            array('label' => 'Expired', 'description' => 'Coupon has reached its expiration date.'),
            array('label' => 'Suspended', 'description' => 'Coupon has been suspended by the administration.'),
        );

        \App\ServiceCouponStatus::insert($data); // Eloquent approach
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_coupon_statuses');
    }
}

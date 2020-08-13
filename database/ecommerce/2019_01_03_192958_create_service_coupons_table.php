<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_coupons', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('service_package_id');        
            $table->unsignedInteger('service_coupon_discount_type_id'); // dollar / percent
            $table->decimal('amount_value', 6, 2)->nullable();
            $table->decimal('percent_value', 5, 2)->nullable();
            $table->string('label', 50)->index();
            $table->string('secret_value', 50)->index();
            $table->string('note')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->boolean('infinite_usage')->default(false);
            $table->unsignedInteger('service_coupon_status_id')->default(1);
            $table->timestamps();
        });

         $data = [
            [
                'user_id' => 1,
                'service_package_id' => 1,
                'service_coupon_discount_type_id' => 1,
                'amount_value' => 25.25,
                'percent_value' => null,
                'label' => 'Opening Coupon Fire',
                'secret_value' => '&CE-edS_Fjfw',
                'note' => '',
                'expires_at' => null,
                'infinite_usage' => true,
                'service_coupon_status_id' => 1,
            ],
            [
                'user_id' => 1,
                'service_package_id' => 1,
                'service_coupon_discount_type_id' => 2,
                'amount_value' => null,
                'percent_value' => 50,
                'label' => 'Opening Coupon Fire',
                'secret_value' => '&CE-edS_Fjfw',
                'note' => '',
                'expires_at' => null,
                'infinite_usage' => true,
                'service_coupon_status_id' => 1,
            ],
            [
                'user_id' => 1,
                'service_package_id' => 2,
                'service_coupon_discount_type_id' => 1,
                'amount_value' => 25.25,
                'percent_value' => null,
                'label' => 'Opening Coupon Fire',
                'secret_value' => '&CE-edS_Fjfw',
                'note' => '',
                'expires_at' => null,
                'infinite_usage' => true,
                'service_coupon_status_id' => 1,
            ],
            [
                'user_id' => 1,
                'service_package_id' => 2,
                'service_coupon_discount_type_id' => 2,
                'amount_value' => null,
                'percent_value' => 50,
                'label' => 'Opening Coupon Fire',
                'secret_value' => '&CE-edS_Fjfw',
                'note' => '',
                'expires_at' => null,
                'infinite_usage' => true,
                'service_coupon_status_id' => 1,
            ],
            
        ];

        \App\ServiceCoupon::insert($data); // Eloquent approach
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_coupons');
    }
}

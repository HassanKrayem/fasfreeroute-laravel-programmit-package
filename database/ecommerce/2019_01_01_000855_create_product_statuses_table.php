<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('css_background_color',20)->nullable();
            $table->string('css_text_color',20)->nullable();
            $table->string('css_class')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });


        $data = array(
            array(
                'label' => 'Just Created',
                'css_background_color' => '',
                'css_text_color' => '',
                'css_class' => '',
                'description' => ''
            ),

            array(
                'label' => 'Available',
                'css_background_color' => '',
                'css_text_color' => '',
                'css_class' => '',
                'description' => ''
            ),

            array(
                'label' => 'Low Stock Quantity',
                'css_background_color' => '',
                'css_text_color' => '',
                'css_class' => '',
                'description' => ''
            ),

            array(
                'label' => 'Out of Stock',
                'css_background_color' => '',
                'css_text_color' => '',
                'css_class' => '',
                'description' => ''
            ),
        );

        \App\ProductStatus::insert($data); // Eloquent approach
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_statuses');
    }
}

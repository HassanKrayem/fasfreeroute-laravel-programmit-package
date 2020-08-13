<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_account_statuses', function (Blueprint $table) {
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
            array('label' => 'Initialized', 'description' => 'User Account has Just Been Created.'),
            array('label' => 'Cancelled', 'description' => ''),
            array('label' => 'Pending', 'description' => ''),
            array('label' => 'Suspended', 'description' => ''),
            array('label' => 'Approved', 'description' => ''),
        );

        DB::table('user_account_statuses')->insert($data); // Query Builder approach
        // \App\UserAccountStatus::insert($data); // Eloquent approach
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_account_statuses');
    }
}

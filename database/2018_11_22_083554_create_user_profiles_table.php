<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->smallInteger('profile_id');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        $data = array(
            array('label' => 'Root', 'profile_id' => 1, 'description' => ''),
            array('label' => 'Client', 'profile_id' => 2, 'description' => ''),
            array('label' => 'Agent', 'profile_id' => 3, 'description' => ''),
            array('label' => 'Reseller', 'profile_id' => 4, 'description' => ''),
            array('label' => 'Vendor', 'profile_id' => 5, 'description' => ''),
            array('label' => 'Supplier', 'profile_id' => 6, 'description' => ''),
        );

        // \App\UserProfile::insert($data); // Eloquent approach
        DB::table('user_profiles')->insert($data); // Query Builder approach
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}

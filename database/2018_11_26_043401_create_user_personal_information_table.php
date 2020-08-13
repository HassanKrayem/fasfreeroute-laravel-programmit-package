<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_personal_information', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            // Personal Information
            $table->string('first_name',  20)->nullable();
            $table->string('middle_name',  20)->nullable();
            $table->string('last_name', 20)->nullable();
            $table->date('birth_date')->nullable();
            $table->unsignedInteger('user_gender_id')->nullable();
            $table->string('profile_photo_url')->nullable(); // full path to profile file.

            // contact information
            $table->string('mobile_number')->nullable();
            $table->string('home_number')->nullable();
            $table->string('office_number')->nullable();

            // Address Field
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('region')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();

             // Social Media Accounds Links
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('googleplus')->nullable();
            $table->string('instagram')->nullable();

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
        Schema::dropIfExists('user_personal_information');
    }
}

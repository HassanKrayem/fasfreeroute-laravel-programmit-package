<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentityProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->String('title')->nullable();
            $table->text('about')->nullable();
            $table->text('brief_of_about')->nullable();
            $table->text('services_agreement_statement')->nullable();
            $table->text('policies_statement')->nullable();
            $table->text('privacy_statement')->nullable();            
            $table->string('started_Since')->nullable();
            $table->string('open_time')->nullable();
            $table->string('close_time')->nullable();
            $table->string('contact_numbers')->nullable();
            $table->string('contact_emails')->nullable();
            $table->string('contact_form_email')->email();
            $table->string('location')->nullable();
            $table->string('map_picture')->nullable(); //file path            
            $table->string('map_coordinates_langlat')->nullable(); //file path
            $table->string('social_link_facebook')->nullable();
            $table->string('social_link_twitter')->nullable();
            $table->string('social_link_linkedin')->nullable();
            $table->string('social_link_google_plus')->nullable();
            $table->string('social_link_youtube')->nullable();
            $table->string('social_link_instagram')->nullable();
            $table->String('copyright_notice')->nullable();
            $table->string('lang')->nullable();
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
        Schema::dropIfExists('identity_profiles');
    }
}

<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_profile_id')->enum('user_profile_id', [1, 2, 3, 4, 5, 6, 7]);            

            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedInteger('user_account_status_id')->default(3);
            $table->boolean('verified_email')->default(false);
            $table->text("account_status_message")->nullable();
            $table->decimal('money_balance', 12, 2)->default(0.00);//->default(99.999999);

            $table->timestamps();
            $table->rememberToken();
        });

        $data = [
            [
                'user_profile_id' => 1,
                'username' => 'root',
                'email' => 'root@system.com',
                'password' => Hash::make('defaultPassword'),
                'user_account_status_id' => 5,
                'verified_email' => true,
                'account_status_message' => '',
            ],
        ];

        //App\User::insert($data); // Eloquent approach
        DB::table('users')->insert($data); // Query Builder approach
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

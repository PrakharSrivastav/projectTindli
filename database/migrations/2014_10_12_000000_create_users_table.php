<?php

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
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('password', 80);
            $table->softDeletes();
            # ENUM 0->inactive , 1->inactive
            $table->enum('active',[0,1])->default(0);   
            # Enum 0->unknown , 1->male, 2->female
            $table->enum('gender',[0,1,2])->default(0);
            $table->date('dob')->nullable();
            $table->string('img_path',50)->nullable();
            # regular contact number
            $table->string("contact_num",20)->nullable();
            # sms cotact number
            $table->string("mobile_num",20)->nullable();
            # agreed to terms and conditions 0->no ,1->yes :: 0 by default
            $table->enum("tnc",[0,1])->default(0);
            $table->rememberToken();
            $table->string('registration_token', 40)->nullable();
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
        Schema::drop('users');
    }
}

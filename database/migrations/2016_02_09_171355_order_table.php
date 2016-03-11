<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_name', 100);//
            $table->integer('sender_id')->unsigned()->nullable();
            $table->integer('carrier_id')->unsigned()->nullable();
            $table->string('from_city', 200); //
            $table->string('from_city_id', 100);//
            $table->string('to_city', 200);//
            $table->string('to_city_id', 100);//
            # order status (0->new,1->confirmed,2->carried_at,3->delivered,4->undelivered)
            # current in scope values are 0,1. Have put more for future use
            $table->enum('status', ['0', '1','2','3','4'])->nullable()->default('0');
            $table->text('description')->nullable();//
            $table->string('img_path', 100)->nullable();//
            $table->string('type', 100);//
            $table->string('size', 100);//
            $table->double('price', 15, 8)->nullable()->default(0.000);//
            $table->boolean('has_insurance')->default(false);
            $table->integer('insurence_id')->unsigned()->nullable();
            $table->string('secret_code', 100)->nullable();
            $table->softDeletes();
            $table->dateTime('travel_date')->nullable();
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
        Schema::drop('orders');
    }
}

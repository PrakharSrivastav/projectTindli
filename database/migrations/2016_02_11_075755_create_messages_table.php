<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("from");
            $table->unsignedInteger("to");
            $table->text("message")->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("from")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");
            $table->foreign("to")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");
            # 0->apply,1->normal,2->withdrawn,3->reject
            $table->integer('order_id')->unsigned();
            $table->enum('type', ['0', '1', '2','3'])->default('0');
            $table->string('from_name', 100)->default('');
            $table->string('to_name', 100)->default('');
            $table->integer('reader')->unsigned();
            # 0->unread , 1->read
            $table->enum('read', ['0', '1'])->default('1');
            $table->integer('sender')->unsigned()->nullable()->default(12);
            $table->string('sender_name', 500)->nullable();
            $table->string('sender_img', 500)->nullable();
            $table->string('reader_name', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}

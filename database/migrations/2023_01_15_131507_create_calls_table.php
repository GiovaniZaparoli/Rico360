<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->string('call_sid');
            $table->string('status');
            $table->string('duration');
            $table->bigInteger('caller_user_id')->unsigned()->index();
            $table->bigInteger('receiver_user_id')->unsigned()->index();
            $table->foreign('caller_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('calls');
    }
};
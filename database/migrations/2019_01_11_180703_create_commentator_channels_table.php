<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentatorChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentator_channels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('commentator_id');            
            $table->foreign('commentator_id')->references('id')->on('commentators')->onDelete('CASCADE');
            $table->unsignedInteger('channel_id');            
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('CASCADE');
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
        Schema::dropIfExists('commentator_channels');
    }
}

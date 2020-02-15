<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('quality', ['MAIN', 'HIGH', 'MEDIUM', 'LOW']);
            $table->enum('work_on', ['ALL', 'DESKTOP', 'MOBILE']);
            $table->unsignedInteger('server_type_id');            
            $table->foreign('server_type_id')->references('id')->on('server_types')->onDelete('CASCADE');
            $table->string('code');
            $table->unsignedInteger('channel_id');            
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('CASCADE');
            $table->boolean('is_featured')->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('ads_block')->default(1);
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
        Schema::dropIfExists('servers');
    }
}

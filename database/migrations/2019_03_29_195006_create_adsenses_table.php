<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adsenses', function (Blueprint $table) {
            $table->increments('id');
            $table->text('desktop_code')->nullable();
            $table->text('mobile_code')->nullable();
            $table->text('video_code')->nullable();
            $table->boolean('desktop_code_active')->default(1);
            $table->boolean('mobile_code_active')->default(1);
            $table->boolean('video_code_active')->default(1);
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
        Schema::dropIfExists('adsenses');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedBigInteger('match_id')->unique();
            
            $table->unsignedInteger('league_id');            
            $table->foreign('league_id')->references('league_id')->on('leagues')->onDelete('CASCADE');

            $table->string('localteam_name');                        
            $table->string('localteam_logo');                        
            $table->string('visitorteam_name');            
            $table->string('visitorteam_logo');            
            
            $table->integer('localteam_score')->nullable();
            $table->integer('visitorteam_score')->nullable();
            $table->integer('localteam_pen_score')->nullable();
            $table->integer('visitorteam_pen_score')->nullable();
            $table->string('ht_score')->nullable();
            $table->string('ft_score')->nullable();
            $table->string('et_score')->nullable();

            $table->string('status');
            $table->timestamp('date_time');

            $table->string('blog_mobile_url')->nullable();
            $table->string('blog_desktop_url')->nullable();

            $table->string('slug')->nullable()->unique();

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
        Schema::dropIfExists('matches');
    }
}

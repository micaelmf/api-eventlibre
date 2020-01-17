<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type');
            $table->string('durations');
            $table->string('description');
            $table->string('level');
            $table->string('place');
            $table->string('archive');
            $table->string('status');
            
            //event for the activity
            $table->bigInteger('event_id')->unsigned();
            $table->foreign('event_id')
                ->references('id')->on('events')
                ->onDelete('cascade');  
            
            //speaker for the activity
            $table->bigInteger('speaker_id')->unsigned();
            $table->foreign('speaker_id')
                ->references('id')->on('speakers')
                ->onDelete('cascade');   
            
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
        Schema::dropIfExists('activities');
    }
}

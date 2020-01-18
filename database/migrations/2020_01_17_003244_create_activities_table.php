<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
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
            $table->string('description')->nullable();
            $table->string('level')->nullable();
            $table->string('local');
            $table->string('space')->nullable();
            $table->string('archive')->nullable();
            $table->string('status');
            $table->bigInteger('event_id')->unsigned();
            $table->bigInteger('speaker_id')->unsigned();
            $table->timestamps();
            
            //event for the activity
            $table->foreign('event_id')
                ->references('id')->on('events')
                ->onDelete('cascade');  
            
            //speaker for the activity
            $table->foreign('speaker_id')
                ->references('id')->on('speakers')
                ->onDelete('cascade'); 
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

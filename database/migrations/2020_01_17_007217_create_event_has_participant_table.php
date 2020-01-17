<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventHasParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_has_participant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('event_id');
            $table->unsignedbigInteger('participant_id');

            $table->foreign('event_id')
                ->references('id')->on('events')
                ->onDelete('cascade');
            
            $table->foreign('participant_id')
                ->references('id')->on('participants')
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
        Schema::dropIfExists('event_has_participant');
    }
}

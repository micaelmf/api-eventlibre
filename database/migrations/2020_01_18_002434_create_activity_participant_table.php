<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_participant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('activity_id');
            $table->unsignedbigInteger('participant_id');

            $table->foreign('activity_id')
                ->references('id')->on('activities')
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
        Schema::dropIfExists('activity_participant');
    }
}

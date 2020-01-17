<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityHasParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_has_participant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('activity_id');
            $table->unsignedbigInteger('participant_id');

            $table->foreign('activity_id')
                ->references('id')->on('activity')
                ->onDelete('cascade');
            
            $table->foreign('participant_id')
                ->references('id')->on('participant')
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
        Schema::dropIfExists('activity_has_participant');
    }
}

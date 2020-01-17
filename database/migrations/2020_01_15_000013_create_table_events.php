<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('about');
            $table->string('period');
            $table->string('image');
            $table->string('link_photos');
            $table->string('link_registrations');
            $table->string('edition');
            $table->date('data_start_event');
            $table->date('data_end_event');
            $table->date('data_start_registrations');
            $table->date('data_end_registrations');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            
            //event creator user
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('events');
    }
}

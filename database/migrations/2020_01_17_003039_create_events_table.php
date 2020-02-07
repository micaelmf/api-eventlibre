<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
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
            $table->string('link_photos')->nullable();
            $table->string('link_registrations')->nullable();
            $table->string('edition');
            $table->date('date_start_event');
            $table->date('date_end_event')->nullable();
            $table->date('date_start_registrations');
            $table->date('date_end_registrations')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('address_id')->unsigned();
            $table->timestamps();
            
            //event creator user
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            //address of event
            $table->foreign('address_id')
                ->references('id')->on('addresses')
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

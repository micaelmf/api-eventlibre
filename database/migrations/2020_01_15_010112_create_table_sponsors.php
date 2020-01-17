<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSponsors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type');
            $table->string('image');
<<<<<<< HEAD
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            
            //event
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
=======
            
            //event
            $table->bigInteger('event_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            
            $table->timestamps();
>>>>>>> dcb4ac0fd92195495bef9dc428acd5ab46fcd18b
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}

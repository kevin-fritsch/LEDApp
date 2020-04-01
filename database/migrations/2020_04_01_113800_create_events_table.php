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
            $table->id();
            $table->integer('duration');
            $table->boolean('ledStatus');
            $table->unsignedBigInteger('voiceevent_id');
            $table->unsignedBigInteger('led_id');
            $table->timestamps();
            $table->foreign('voiceevent_id')->references('id')->on('voiceevents')->onDelete('cascade');
            $table->foreign('led_id')->references('id')->on('leds')->onDelete('cascade');
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

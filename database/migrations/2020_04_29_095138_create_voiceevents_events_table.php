<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoiceeventsEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voiceevents_events', function (Blueprint $table) {
            $table->integer('voiceevent_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->foreign('voiceevent_id')->references('id')->on('voiceevents')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voiceevents_events');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('location');
            $table->text('body');
            $table->date('event_start_date');
            $table->date('event_end_date')->nullable();
            $table->date('register_start_date');
            $table->date('register_end_date');
            $table->unsignedSmallInteger('slots');
            $table->unsignedSmallInteger('participants_max');
            $table->unsignedSmallInteger('alternates_max');
            $table->unsignedTinyInteger('active')->default(0);
            $table->unsignedTinyInteger('closed')->default(0);
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
        Schema::dropIfExists('race_events');
    }
}

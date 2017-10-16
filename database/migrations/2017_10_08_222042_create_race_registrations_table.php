<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('race_event_id');
            $table->unsignedInteger('team_id');
            $table->unsignedTinyInteger('submitted')->default(0);
            $table->unsignedTinyInteger('approved')->default(0);
            $table->unsignedTinyInteger('paid')->default(0);
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
        Schema::dropIfExists('race_registrations');
    }
}

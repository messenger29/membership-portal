<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceRegistrationCrewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_registration_crews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('race_registration_id');
            $table->string('name');
            // $table->unsignedSmallInteger('crew_type');
            $table->string('crew_type');
            $table->unsignedSmallInteger('crew_rank')->nullable();
            $table->string('partners')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedTinyInteger('approved')->default(0);
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
        Schema::dropIfExists('race_registration_crews');
    }
}

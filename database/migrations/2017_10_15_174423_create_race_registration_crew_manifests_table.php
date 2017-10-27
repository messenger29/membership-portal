<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceRegistrationCrewManifestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_registration_crew_manifests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('race_registration_crew_id');
            $table->unsignedInteger('user_id');
            $table->unsignedTinyInteger('approved')->default(0);
            $table->unsignedInteger('version');
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
        Schema::dropIfExists('race_registration_crew_manifests');
    }
}

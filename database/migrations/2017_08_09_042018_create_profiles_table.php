<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_initial', 5)->nullable()->default(null);
            $table->string('street');
            $table->string('street2')->nullable()->default(null);
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('phone_primary', 20);
            $table->string('phone_alt', 20)->nullable()->default(null);
            $table->date('birthdate');
            $table->string('gender');
            $table->string('emerg_name');
            $table->string('emerg_relation');
            $table->string('emerg_phone_primary', 20);
            $table->string('emerg_phone_alt', 20)->nullable()->default(null);
            $table->string('emerg2_name')->nullable()->default(null);
            $table->string('emerg2_relation')->nullable()->default(null);
            $table->string('emerg2_phone_primary', 20)->nullable()->default(null);
            $table->string('emerg2_phone_alt', 20)->nullable()->default(null);
            $table->string('avatar')->default('default.jpg');
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
        Schema::dropIfExists('profiles');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waivers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('waivertext_id');
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('youth_flag')->comment('signee was under age of 18 at time of signing')->default(0);
            $table->unsignedTinyInteger('youth_agree_flag')->comment('signee agreed to obtain parent/guardian signature on separate form')->default(0);
            $table->text('medical_notes')->nullable();
            $table->unsignedTinyInteger('agree_flag')->default(0);
            $table->string('signature');
            $table->unsignedTinyInteger('youth_submitted')->default(0)->comment('signee turned in separate form');
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
        Schema::dropIfExists('waivers');
    }
}

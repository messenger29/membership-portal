<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaivertextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waivertext', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('year');
            $table->string('title');
            $table->string('version');
            $table->text('body');
            $table->unsignedTinyInteger('active_flag');
            $table->date('active_date');
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
        Schema::dropIfExists('waivertext');
    }
}

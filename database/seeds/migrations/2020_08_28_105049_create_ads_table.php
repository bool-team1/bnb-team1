<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('apartment_id');
            //Set apartment_id as foreign key
            $table->foreign('apartment_id')->references('id')->on('apartments');
            $table->unsignedBigInteger('plan_id');
            //Set plan_id as foreign key
            $table->foreign('plan_id')->references('id')->on('plans');

            $table->date('start');
            $table->date('end');
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
        Schema::dropIfExists('ads');
    }
}

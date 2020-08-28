<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_plan', function (Blueprint $table) {
            $table->unsignedBigInteger('ad_id');
            //Set ad_id as foreign key
            $table->foreign('ad_id')->references('id')->on('ads');

            $table->unsignedBigInteger('plan_id');
            //Set plan_id as foreign key
            $table->foreign('plan_id')->references('id')->on('plans');

            $table->primary(['ad_id', 'plan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_plan');
    }
}

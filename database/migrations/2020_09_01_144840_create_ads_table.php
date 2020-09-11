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
           $table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('cascade');


           //Set plan_id as foreign key
           $table->foreignId('plan_id')->constrained('plans');

           $table->timestamp('start')->nullable();
           $table->timestamp('end')->nullable();
           $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
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

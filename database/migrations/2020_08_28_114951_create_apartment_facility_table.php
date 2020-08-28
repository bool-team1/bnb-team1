<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentFacilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_facility', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id');
            //Set apartment_id as foreign key
            $table->foreign('apartment_id')->references('id')->on('apartments');

            $table->unsignedBigInteger('facility_id');
            //Set facility_id as foreign key
            $table->foreign('facility_id')->references('id')->on('facilities');

            $table->primary(['apartment_id', 'facility_id']);

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
        Schema::dropIfExists('apartment_facility');
    }
}

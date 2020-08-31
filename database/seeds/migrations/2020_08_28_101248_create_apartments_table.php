<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            //Set user_id as foreign key
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('title', 30)->nullable(false);
            $table->string('address', 100)->nullable(false)->unique();
            $table->tinyInteger('rooms_n');
            $table->tinyInteger('bathrooms_n');
            $table->float('square_mt');
            $table->decimal('longitude', 11, 8);
            $table->decimal('latitude', 10, 8);
            $table->string('slug', 50)->unique();
            $table->boolean('isPublic');
            $table->string('main_pic');
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
        Schema::dropIfExists('apartments');
    }
}

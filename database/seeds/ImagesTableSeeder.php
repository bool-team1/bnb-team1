<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(Faker $faker)
     {
         for ($i = 0; $i < 10; $i++){
             $newImage = new Image();
             $newImage->apartment_id = $faker->numberBetween(1, 10);
             $newImage->image_url = $faker->imageUrl(640, 480);


             $newImage->save();
         }
     }
}

<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Apartment;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(Faker $faker)
     {
         for ($i = 0; $i < 10; $i++){
             $newApartment = new Apartment();
             $newApartment->user_id = $faker->numberBetween(1, 10);
             $newApartment->title = $faker->streetName;
             $newApartment->address = $faker->address;
             $newApartment->rooms_n = $faker->numberBetween(1, 7);
             $newApartment->bathrooms_n = $faker->numberBetween(1, 3);
             $newApartment->square_mt = $faker->numberBetween(100, 900);
             $newApartment->longitude = $faker->randomFloat(6, 0, 999.99);
             $newApartment->latitude = $faker->randomFloat(6, 0, 99.99);
             $newApartment->slug = Helper::slugify($newApartment->title);
             $newApartment->isPublic = $faker->numberBetween(0, 1);
             $newApartment->main_pic = $faker->imageUrl(640, 480);

             $newApartment->save();
         }
     }
}

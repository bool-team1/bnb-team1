<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Ad;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {
            $newAd = new Ad();
            $newAd->apartment_id = $faker->numberBetween(1, 10);
            $newAd->plan_id = $faker->numberBetween(1, 3);
            $newAd->start = $faker->dateTime('now');

            $newAd->save();
        }
    }
}

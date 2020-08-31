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
        for ($i=0; $i < 5; $i++) {
            $newAd = new Ad();
            $newAd->apartment_id = $i + 1;
            $newAd->plan_id = rand(1, 3);
            $newAd->start = $faker->dateTime('now');
            $newAd->end = '2050-08-28 14:35:03';

            $newAd->save();
        }
    }
}

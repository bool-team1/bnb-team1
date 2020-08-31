<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'hours_n' => 24,
                'price' => 2.99
            ],
            [
                'hours_n' => 72,
                'price' => 5.99
            ],
            [
                'hours_n' => 144,
                'price' => 9.99
            ]
        ];

        foreach ($plans as $plan) {
            $newPlan = new Plan();
            $newPlan->hours_n = $plan['hours_n'];
            $newPlan->price = $plan['price'];

            $newPlan->save();
        }
    }
}

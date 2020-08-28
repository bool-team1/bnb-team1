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
                'days_n' => 1,
                'price' => 2.99
            ],
            [
                'days_n' => 3,
                'price' => 5.99
            ],
            [
                'days_n' => 6,
                'price' => 9.99
            ]
        ];

        foreach ($plans as $plan) {
            $newPlan = new Plan();
            $newPlan->days_n = $plan['days_n'];
            $newPlan->price = $plan['price'];

            $newPlan->save();
        }
    }
}

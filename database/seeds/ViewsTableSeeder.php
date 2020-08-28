<?php

use Illuminate\Database\Seeder;
use App\View;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 100; $i++) {
            $newView = new View();
            $newView->apartment_id = rand(1, 10);

            $newView->save();
        }
    }
}

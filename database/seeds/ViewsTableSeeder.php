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
        for ($i=0; $i < 13; $i++) {
            $newView = new View();
            $newView->apartment_id = 6;
            $newView->created_at = date('2020-' . $i . '-01 00:00:00');

            $newView->save();
        }
    }
}

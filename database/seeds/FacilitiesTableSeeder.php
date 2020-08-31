<?php

use Illuminate\Database\Seeder;
use App\Facility;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facilities = [
            'wifi', 'piscina', 'sauna', 'posto macchina', 'portineria', 'vista mare'
        ];
        foreach ($facilities as $facility) {
            $newFacility = new Facility;
            $newFacility->type = $facility;
            $newFacility->save();
        }
    }
}

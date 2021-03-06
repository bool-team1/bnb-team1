<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ApartmentsTableSeeder::class);
        $this->call(AdsTableSeeder::class);
        $this->call(ViewsTableSeeder::class);
        $this->call(FacilitiesTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
    }
}

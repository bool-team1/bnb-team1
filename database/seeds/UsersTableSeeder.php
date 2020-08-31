<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++){
            $newUser = new User();
            $newUser->name = $faker->firstName;
            $newUser->surname = $faker->lastName;
            $newUser->date_of_birth = $faker->dateTimeThisCentury;
            $newUser->email = $faker->email;
            $newUser->password = $faker->password;
            $newUser->save();
        }
    }
}

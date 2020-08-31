<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(Faker $faker)
     {
         for ($i = 0; $i < 10; $i++){
             $newMessage = new Message();
             $newMessage->apartment_id = $faker->numberBetween(1, 10);
             $newMessage->object = $faker->catchPhrase();
             $newMessage->body = $faker->realText(500);
             $newMessage->sender = $faker->name();
             $newMessage->sender_email = $faker->email();

             $newMessage->save();
         }
     }
}

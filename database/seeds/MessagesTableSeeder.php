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
         for ($i = 1; $i < 4; $i++){
             $newMessage = new Message();
             $newMessage->apartment_id = 15;
             $newMessage->object = $faker->catchPhrase();
             $newMessage->body = $faker->realText(500);
             $newMessage->sender = $faker->name();
             $newMessage->sender_email = $faker->email();
             $newMessage->created_at = date('2020-' . $i . '-01 00:00:00');

             $newMessage->save();
         }
     }
}

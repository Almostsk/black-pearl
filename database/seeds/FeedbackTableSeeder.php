<?php

use Illuminate\Database\Seeder;

class FeedbackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feedbacks')->insert([
            [
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'mobile_phone' => '+1111111111',
                'message' => 'name name name name name name name name name',
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'janedoe@gmail.com',
                'mobile_phone' => '+1111222222',
                'message' => 'Jane Jane Jane Jane Jane Jane Jane Jane Jane',
            ]
        ]);
    }
}

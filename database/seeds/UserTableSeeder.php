<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Даша',
                'surname' => 'Полянская',
                'is_admin' => true,
                'city_id' => 24,
                'mobile_phone' => '380111111111',
                'status_id' => 3,
                'can_be_brand_face' => false,
                'about_me' => 'Я Даша',
                'avatar' => '',
                'password' => bcrypt(config('app.user_password')),
            ]
        ]);
    }
}

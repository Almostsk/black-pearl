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
                'name' => 'Дарина',
                'surname' => 'Дима привет',
                'is_admin' => true,
                'city_id' => 116,
                'mobile_phone' => '+380111111111',
                'status_id' => 3,
                'can_be_brand_face' => true,
                'about_me' => 'Я Даша',
                'avatar' => '',
                'password' => bcrypt(config('app.user_password')),
            ],
            [
                'name' => 'Первый',
                'surname' => 'Пользователь',
                'is_admin' => false,
                'city_id' => 117,
                'mobile_phone' => '+380994443333',
                'status_id' => 3,
                'can_be_brand_face' => true,
                'about_me' => 'Я Первый Пользователь',
                'avatar' => '',
                'password' => bcrypt(config('app.user_password')),
            ]
        ]);
    }
}

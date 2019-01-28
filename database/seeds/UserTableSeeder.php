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
                'surname' => 'Полянська',
                'is_admin' => true,
                'city_id' => 116,
                'mobile_phone' => '+380994444444',
                'is_mobile_verified' => true,
                'is_profile_moderated' => true,
                'can_be_brand_face' => true,
                'about_me' => 'Я Даша',
                'avatar' => '/',
                'password' => bcrypt('yadasha'),
            ],
            [
                'name' => 'Первый',
                'surname' => 'Пользователь',
                'is_admin' => false,
                'city_id' => 117,
                'mobile_phone' => '+380994443333',
                'is_mobile_verified' => true,
                'is_profile_moderated' => true,
                'can_be_brand_face' => true,
                'about_me' => 'Я Первый Пользователь',
                'avatar' => '',
                'password' => bcrypt('111111'),
            ]
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            [
                'status_code' => 'on_moderation',
                'status_name' => 'На модерації'
            ],
            [
                'status_code' => 'blocked',
                'status_name' => 'Заблокований'
            ],
            [
                'status_code' => 'active',
                'status_name' => 'Активний'
            ],
        ]);
    }
}

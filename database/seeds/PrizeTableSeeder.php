<?php

use Illuminate\Database\Seeder;

class PrizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prizes')->insert([
            [
                'name' => 'Чорна перлина',
            ],
            [
                'name' => 'Обличчя рекламної кампанії',
            ]
        ]);
    }
}

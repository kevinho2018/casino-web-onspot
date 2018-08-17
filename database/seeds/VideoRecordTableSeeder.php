<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon as Carbon;

class VideoRecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        //DB::table('VideoRecord')->delete();

        for ($i=0; $i<10; $i++) {
            DB::table('VideoRecord')->insert([
                'TableId' => $faker->randomElement(['E', 'F', 'G', 'H']),
                'Round' => rand(1000000, 9999999),
                'Run' => rand(1, 100),
                'StartTime' => $faker->dateTime('now') // 牌局開始時間
            ]);
        }
    }
}

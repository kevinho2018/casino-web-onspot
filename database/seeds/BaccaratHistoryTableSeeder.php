<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon as Carbon;

class BaccaratHistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $carbon = new Carbon();

        //DB::table('BaccaratHistory')->delete();

        for ($i=0; $i<10; $i++) {
            DB::table('BaccaratHistory')->insert([
                'TableId' => $faker->randomElement(['E', 'F', 'G', 'H']),
                'Round' => rand(1000000, 9999999),
                'Run' => rand(1, 100),
                // 牌局結果：莊家Banker、閒家Player、和局Tie
                'WinSpot' => $faker->randomElement(['Banker', 'Player', 'Tie']),
                // S：黑桃、D：方塊、C：梅花、H：紅心
                'Card1' => $faker->randomElement(['S', 'D', 'C', 'H']) . rand(0,9),
                'Card2' => $faker->randomElement(['S', 'D', 'C', 'H']) . rand(0,9),
                'Card3' => $faker->randomElement(['S', 'D', 'C', 'H']) . rand(0,9),
                'Card4' => $faker->randomElement(['S', 'D', 'C', 'H']) . rand(0,9),
                'Card5' => $faker->randomElement(['S', 'D', 'C', 'H']) . rand(0,9),
                'Card6' => $faker->randomElement(['S', 'D', 'C', 'H']) . rand(0,9),
                // 牌局狀態：未修改Normal、改單Modified、事後取消Canceled
                'ModifiedStatus' => $faker->randomElement(['Normal', 'Modified', 'Canceled']),
                'ModifiedTime' => $faker->dateTime('now'),
                'CreateTime' => $carbon::now()
            ]);
        }
    }
}

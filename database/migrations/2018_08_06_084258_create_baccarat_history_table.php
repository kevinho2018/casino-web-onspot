<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaccaratHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BaccaratHistory', function (Blueprint $table) {
            $table->increments('HistoryId');
            $table->string('TableId', 2)
                ->comment('桌號');
            $table->unsignedInteger('Round')
                ->comment('輪號');
            $table->unsignedInteger('Run')
                ->comment('局號');
            $table->enum('WinSpot', ['Banker', 'Player', 'Tie'])
                ->comment('牌局結果:莊家(Banker), 閒家(Player), 和(Tie)');
            $table->string('Card1', 4)
                ->comment('閒1');
            $table->string('Card2', 4)
                ->comment('莊1');
            $table->string('Card3', 4)
                ->comment('閒2');
            $table->string('Card4', 4)
                ->comment('莊2');
            $table->string('Card5', 4)
                ->comment('閒補3');
            $table->string('Card6', 4)
                ->comment('莊補3');
            $table->enum('ModifiedStatus', ['Normal', 'Modified', 'Canceled'])
                ->comment('牌局狀態:未修改(Normal),改單(Modified),事後取消(Canceled)');
            $table->dateTime('ModifiedTime')
                ->comment('牌局修改時間');
            $table->dateTime('CreateTime');

            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->unique(['TableId', 'Round', 'Run']);
            $table->index('ModifiedTime');
            $table->index('CreateTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('BaccaratHistory');
    }
}

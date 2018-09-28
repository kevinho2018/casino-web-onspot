<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoRecordTable extends Migration
{
    /**
* Run the migrations.
*
* @return void
*/
    public function up()
    {
        Schema::create('VideoRecord', function (Blueprint $table) {
            $table->increments('RecordId');
            $table->string('TableId', 2)
                ->comment('桌號');
            $table->unsignedInteger('Round')
                ->comment('輪號');
            $table->unsignedInteger('Run')
                ->comment('局號');
            $table->dateTime('StartTime')
                ->comment('牌局開始時間');

            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->index(['TableId', 'Round', 'Run']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('VideoRecord');
    }
}

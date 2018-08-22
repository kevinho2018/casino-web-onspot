<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerApiCallRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ServerApiCallRecord', function (Blueprint $table) {
            $table->increments('ServerApiId');
            $table->string('IP');
            $table->string('Url')
                ->default('')
                ->nullable();
            $table->string('RequestParams')
                ->default('')
                ->nullable();
            $table->boolean('ResponseStatus');
            $table->unsignedSmallInteger('ResponseCode');
            $table->string('ResponseFullContent')
                ->default('')
                ->nullable();
            $table->dateTime('RequestTime');
            $table->date('ResponseTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ServerApiCallRecord');
    }
}

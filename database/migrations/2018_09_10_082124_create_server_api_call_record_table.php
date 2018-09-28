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
            $table->enum('Status', ['success', 'failed']);
            $table->string('Account')
                ->comment('使用者帳號');
            $table->string('Ip', 40);
            $table->text('RequestContent')
                ->comment('請求內容');
            $table->string('RequestUrl', 200)
                ->comment('來源url');
            $table->string('RequestMethod', 100)
                ->comment('請求操作 Api');
            $table->text('ResponseContent')
                ->comment('Api 回應內容');
            $table->dateTime('RequestTime');
            $table->dateTime('ResponseTime');
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

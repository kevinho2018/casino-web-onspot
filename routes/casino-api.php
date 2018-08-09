<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/7
 * Time: 上午11:31
 */

/*
|--------------------------------------------------------------------------
| CASINO-API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register CASINO-API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
        'name' => 'baccarat', // name-prefix
        'namespace' => 'Api', // Controllers Within The "App\Http\Controllers\Api" Namespace
        'middleware' => ['fw-block-blacklisted'], // App\Http\Kernel.php
    ],
    function() {
        Route::get('coming/soon', function()
        {
            return "We are about to launch, please come back in a few days.";
        });

        // 百家樂 API -> uri-prefix = 'baccarat'
        // TODO 測試完成後 -> 補上白名單限制 ['fw-only-whitelisted']
        Route::group(['prefix' => 'baccarat'], function () {
            // 查詢牌局紀錄
            Route::get('game/historySearch', 'BaccaratController@getBaccaratHistoryReport')
                //->middleware(['casino-api.verify:startAt,endAt,modifiedStatus'])
                ->name('history');

            // 查詢影片紀錄
            Route::get('video/videoSearch', 'VideoController@getVideoFilePath')
                // TODO api寫好後 再來加入request parameters的驗證
                //->middleware(['casino-api.verify:account,nickname'])
                ->name('videos');
        });
    }
);

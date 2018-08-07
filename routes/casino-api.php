<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/7
 * Time: 上午11:31
 */

Route::group(['namespace' => 'Api', 'middleware' => ['fw-allow-wl']], function() {
    // 查詢牌局紀錄
    Route::get('baccarat/game/historySearch', 'BaccaratController@getBaccaratHistoryReport')->name('game-history');
    // 查詢影片紀錄
    Route::get('baccarat/video/videoSearch', 'VideoController@getVideoFilePath')->name('get-video');
});


/*
Route::group(['namespace' => 'Api', 'middleware' => ['fw-allow-wl']], function () {
    Route::post('player/register', 'PlayerController@register')->middleware(['casinoapi.verify:account,nickname,currency']);
}
*/
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // Override Route

    // 遊戲牌局改單取消頁面 override baccaratHistory
    Route::get('baccaratHistory-page', 'CasinoAdmin\GameResultModifyController@index')
        ->name('baccaratHistory-page')
        ->middleware('admin.user');

    //  Call Game Server 取消牌局耶果
    Route::put('cancel-game-result', 'CasinoAdmin\GameResultModifyController@putCancel')
        ->name('cancel-game-result')
        ->middleware('admin.user');

    // Call Game Server 修改牌局結果
    Route::put('modify-game-result', 'CasinoAdmin\GameResultModifyController@putModify')
        ->name('modify-game-result')
        ->middleware('admin.user');

    // 查詢遊戲牌局頁面
    Route::put('search-game-result-page', 'CasinoAdmin\GameResultController@searchResult')
        ->name('search-game-result-page')
        ->middleware('admin.user');
});

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'Api'], function() {
   Route::get('casino/baccarat/game/history', 'BaccaratController@getHistory')->name('game-history');
   Route::get('casino/baccarat/video', 'VideoController@getVideo')->name('get-video');
});

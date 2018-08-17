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
    Route::put('put-game-result', 'CasinoAdmin\GameResultModifyController@putCancel')
        ->name('put-game-result')
        ->middleware('admin.user');
});

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

Route::get('card', 'HandsController@getHands')->middleware('cors');
Route::get('joker', 'CardController@getJoker')->middleware('cors');
Route::get('winner/{hands}', 'ScoreController@getWinner')->middleware('cors');
Route::post('save','GameController@create')->middleware('cors');
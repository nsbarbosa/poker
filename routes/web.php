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

Route::get('card/{deck}', 'CardController@getHand');
Route::get('joker', 'CardController@getJoker');
Route::get('score/{hand}', 'ScoreController@getScore');
Route::get('winner/{score1}/{score2}', 'ScoreController@getWinner');
Route::post('save','GameController@create');
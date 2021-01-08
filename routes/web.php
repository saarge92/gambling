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

Auth::routes();

Route::get('/home', [
    'uses' => 'HomeController@index',
    'middleware' => 'auth'
])->name('home');

Route::post('/prize/', [
    'uses' => 'PrizeController@generatePrize',
    'middleware' => 'auth'
]);

Route::post('/prize/{id}/reward', [
    'uses' => 'PrizeController@getGeneratedPrize',
    'middleware' => 'auth'
]);

Route::get('/bonus', [
    'uses' => 'AccountLoyaltyController@getCurrentBonusInfo',
    'middleware' => 'auth'
])->name('current_bonus');

Route::post('/bonus/money', [
    'uses' => 'AccountLoyaltyController@changeBonusToMoney',
    'middleware' => 'auth'
]);

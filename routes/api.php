<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('boards','TrelloBoardController');
Route::post('sync_board', 'TrelloBoardController@syncBoard');
Route::resource('lists','TrelloListController');
Route::post('sync_list', 'TrelloListController@syncList');
Route::resource('cards','TrelloCardController');
Route::post('sync_card', 'TrelloCardController@syncCard');
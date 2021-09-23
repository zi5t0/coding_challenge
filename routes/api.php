<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmSearchController;
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


Route::get('', [FilmSearchController::class, 'search']);
/*
Route::get('{query}', array('as'=>'search-api', 'uses'=>'Controllers\FilmSearchController@search'))
    ->where('query','\?q\=.*');*/
/*
Route::fallback(function(){
    return "Invalid query String";
});*/




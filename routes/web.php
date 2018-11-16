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

Route::middleware(['logToDatabase'])->group(function() {
    Route::get('/todos', 'TodoController@index');
    Route::get('/todos/create', 'TodoController@store');
    Route::get('/todos/{todo}', 'TodoController@show');
    Route::get('/todos/{todo}/edit', 'TodoController@update');
    Route::get('/todos/{todo}/delete', 'TodoController@destroy');
});

Route::get('weather', 'WeatherController@create');

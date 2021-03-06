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

Route::get('/', 'MessageController@getList');

Route::get('/create', 'MessageController@getCreate');

Route::post('/create', 'MessageController@postCreate');

Route::get('/show/{id}', 'MessageController@getShow');

Route::post('/show/{id}', 'MessageController@postShow');

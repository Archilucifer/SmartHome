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

use Illuminate\Support\Facades\Auth;

Route::get('/', static function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/homeCreate', 'HomeController@homeCreate')->name('homeCreate');

Route::get('/rooms/{id}', 'RoomController@index')->name('rooms');
Route::post('rooms/roomCreate/{id}', 'RoomController@roomCreate')->name('roomCreate');

Route::get('/devices', 'DeviceController@index')->name('device');
Route::post('/deviceCreate', 'DeviceController@deviceCreate')->name('deviceCreate');
Route::get('/scan/{homeId}', 'DeviceController@scan')->name('deviceScan');

<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
})->name('home');

Route::get('/led', 'LEDController@index')->name('led');
Route::get('/voiceevent', 'VoiceEventController@index')->name('voiceevent');

Route::get('/led/create', function() {
    return view('led.create');
})->name('createledget');
Route::get('/voiceevent/create', function() {
    return view('voiceevent.create');
})->name('createvoiceeventget');

Route::post('/led/create', 'LEDController@create')->name('createledpost');
Route::post('/voiceevent/create', 'VoiceEventController@create')->name('createvoiceeventpost');

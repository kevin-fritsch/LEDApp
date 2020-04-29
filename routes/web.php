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
    return view('voiceevent.create', ['leds' => App\LED::all()]);
})->name('createvoiceeventget');
Route::get('/led/{led}/edit', function(App\LED $led) {
    return view('led.edit', ['led' => $led]);
})->name('editledget');
Route::get('/voiceevent/{voiceevent}/edit', function(App\VoiceEvent $voiceevent) {
    return view('voiceevent.edit', ['voiceevent' => $voiceevent]);
})->name('editvoiceeventget');

Route::post('/led/create', 'LEDController@create')->name('createledpost');
Route::post('/voiceevent/create', 'VoiceEventController@create')->name('createvoiceeventpost');
Route::post('/led/{led}/edit', 'LEDController@edit')->name('editledpost');
Route::post('/voiceevent/{voiceevent}/edit', 'VoiceEventController@edit')->name('editvoiceeventpost');

Route::post('/led/delete', 'LEDController@delete')->name('deleteledpost');
Route::post('/voiceevent/delete', 'VoiceEventController@delete')->name('deletevoiceeventpost');

Route::post('/getAllEvents', 'EventController@getAll');
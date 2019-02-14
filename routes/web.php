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

// головна сторінка
Route::get('/', 'SubscriberController@create');

// підписатись на сторінку "A"
Route::post('/', 'SubscriberController@store');

// показати ресурс "A"
Route::get('a/{id}', 'SubscriberController@show')->middleware('checkURL');

// відписатись від сторінки "A"
Route::put('a/{id}', 'SubscriberController@update')->middleware('checkURL');


// Адміністративна частина
Route::group(['prefix' => '/admin'], function () {

	// список підписок
	Route::get('/', 'AdminPanelController@index');

	// створити нову підписку
	Route::post('/', 'AdminPanelController@store');

	// оновити дані підписки
	Route::put('/{id}', 'AdminPanelController@update');

	// видалити підписку з БД
	Route::delete('/{id}', 'AdminPanelController@destroy');
});



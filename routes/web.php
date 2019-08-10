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

/*
Route::get('/', 'PagesController@welcome');
Route::get('/login', 'PagesController@login');
Route::get('/create', 'PagesController@create');
Route::get('/games', 'PagesController@games');

Route::post('/create', 'UserController@create');

Route::resource('users', 'UserController');
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/money', 'MoneyController')->middleware('auth');;
Route::resource('/money_type', 'MoneyTypeController')->middleware('auth');;
Route::resource('/games', 'GameController')->middleware('auth');
Route::get('/money/{id}/types', 'MoneyController@types')->name('money.types');
Route::get('/ajaxRequest', 'MoneyController@ajaxRequest')->name('money.ajaxRequest');



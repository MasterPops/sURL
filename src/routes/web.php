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

Route::get('/','welcomecontroller@getCout');
Route::post('/','UrlController@setUrl');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/','welcomecontroller@getCout');
Route::get('/swagger/doc', 'SwaggerController@doc');
Route::get('/{url}','UrlController@getUrl');
Route::delete('/{id}','UrlController@delUrl');

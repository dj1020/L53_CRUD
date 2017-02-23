<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contactUs', 'ContactUsController@index');
Route::post('/submitContact', 'ContactUsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/admin/contacts', 'AdminContactController@index');
Route::get('/admin/contacts/{id}/edit', 'AdminContactController@edit')->name('editContact');
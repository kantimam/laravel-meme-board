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

Auth::routes();

Route::get('/', 'PostController@index');
Route::get('/home', 'PostController@index');
Route::get('/upload', 'PostController@create');
Route::get('/post/{id}', 'PostController@show');


Route::get('/profile', 'HomeController@profile')->name('profile');


Route::post('/post', 'PostController@store');
Route::post('/vote/post', 'PostController@vote');






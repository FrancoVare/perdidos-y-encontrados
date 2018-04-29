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

Route::get('/', 'ItemController@index')->name('home');
Route::get('/home', 'ItemController@index');
Route::get('/materias', 'MateriaController@index');
Route::post('/materias', 'MateriaController@store');
Route::post('/materias/destroy', 'MateriaController@destroy');
Route::post('/items', 'ItemController@store');
Route::get('/items/create','ItemController@create');
Route::get('/items/{item}', 'ItemController@show');
Route::get('/resetPassword', 'ResetPasswordController@create');
Route::post('/resetPassword', 'ResetPasswordController@store');



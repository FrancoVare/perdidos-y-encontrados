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
use App\Http\Middleware\CheckFirstLogin;

Auth::routes();

Route::get('/', 'ItemController@index')->name('home')->middleware('first-login');
Route::get('/home', 'ItemController@index')->middleware('first-login');
Route::post('/items', 'ItemController@store');
Route::get('/items/create','ItemController@create')->middleware('first-login');
Route::get('/items/{item}', 'ItemController@show')->middleware('first-login');
Route::get('/items/tags/{tag}', 'ItemController@index')->middleware('first-login');

Route::get('/materias', 'MateriaController@index');
Route::post('/materias', 'MateriaController@store');
Route::post('/materias/destroy', 'MateriaController@destroy');

Route::get('/pruebas', 'PruebaController@index');
Route::post('/pruebas', 'PruebaController@store');
Route::post('/pruebas/destroy', 'PruebaController@destroy');

Route::get('/tags', 'TagController@index');
Route::post('/tags', 'TagController@store');
Route::post('/tags/destroy', 'TagController@destroy');

Route::get('/laboratorios', 'LaboratorioController@index');
Route::post('/laboratorios', 'LaboratorioController@store');
Route::post('/laboratorios/destroy', 'LaboratorioController@destroy');

Route::get('/sedes', 'SedeController@index');
Route::post('/sedes', 'SedeController@store');
Route::post('/sedes/destroy', 'SedeController@destroy');

Route::get('/resetPassword', 'ResetPasswordController@create');
Route::post('/resetPassword', 'ResetPasswordController@store');



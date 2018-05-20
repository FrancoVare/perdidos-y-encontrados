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
Route::get('/api/items', 'ItemController@apiItems');
Route::get('/items/create','ItemController@create')->middleware('first-login');
Route::get('/items/{item}', 'ItemController@show')->middleware('first-login');
//Route::get('/items/tags/{tag}', 'ItemController@index')->middleware('first-login');

// Route::get('/materias', 'MateriaController@index');
Route::get('/api/materias', 'MateriaController@apiMaterias');
Route::post('/materias', 'MateriaController@store');
Route::post('/materias/destroy', 'MateriaController@destroy');

//Route::get('/pruebas', 'PruebaController@index');
Route::get('/api/pruebas', 'PruebaController@apiPruebas');
Route::post('/pruebas', 'PruebaController@store');
Route::post('/pruebas/destroy', 'PruebaController@destroy');

//Route::get('/tags', 'TagController@index');
Route::get('/api/tags', 'TagController@apiTags');
Route::post('/tags', 'TagController@store');
Route::post('/tags/destroy', 'TagController@destroy');

//Route::get('/laboratorios', 'LaboratorioController@index');
Route::get('/api/laboratorios', 'LaboratorioController@apiLaboratorios');
Route::post('/laboratorios', 'LaboratorioController@store');
Route::post('/laboratorios/destroy', 'LaboratorioController@destroy');

//Route::get('/sedes', 'SedeController@index');
Route::get('/api/sedes', 'SedeController@apiSedes');
Route::post('/sedes', 'SedeController@store');
Route::post('/sedes/destroy', 'SedeController@destroy');

Route::get('/retiros', 'RetiroController@create');
Route::post('/retiros', 'RetiroController@store');

Route::get('/resetPassword', 'ResetPasswordController@create');
Route::post('/resetPassword', 'ResetPasswordController@store');

Route::middleware(['auth'])->group(function () {
    Route::get('images/{name}', function ($name) {
        
        if (!Storage::exists('images/'.$name)) {
            return Response::make('File not found.', 404);
        }

        $file = Storage::get('images/'.$name);
        $type = Storage::mimeType('images/'.$name);
        $response = Response::make($file, 200)->header("Content-Type", $type);
        
        return $response;

    });
    Route::get('seed/{name}', function ($name) {
        
        if (!Storage::exists('seed/'.$name)) {
            return Response::make('File not found.', 404);
        }

        $file = Storage::get('seed/'.$name);
        $type = Storage::mimeType('seed/'.$name);
        $response = Response::make($file, 200)->header("Content-Type", $type);
        
        return $response;

    });
});



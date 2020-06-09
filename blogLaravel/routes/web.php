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

// Rtutas para todos
Route::get('/','WelcomeController@welcome')->name('welcome'); //index
Route::get('/tema/{tema}','ThemeController@show')->name('tema.show'); //articulos de cada tema
Route::get('/buscador','SearchController@index');

// Rutas de los usuarios autenticados
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::put('/usuario-actualizar','UserController@update');

//Rutas de Administrador
Route::get('admin/temas','admin\ThemeController@index');
Route::delete('admin/temas/{tema}','admin\ThemeController@destroy')->name('tema.delete');

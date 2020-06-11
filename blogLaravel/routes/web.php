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
//con este middleware comprobamos primero que sea un usuario autenticado y posteriormente sea administrador, si no no tiene acceso a estas rutas.
Route::middleware(['auth','role:administrador'])->group(function(){
	Route::get('admin/temas','admin\ThemeController@index');
	Route::delete('admin/temas/{tema}','admin\ThemeController@destroy')->name('tema.delete');
	Route::get('admin/temas/{tema}/edit','admin\ThemeController@edit')->name('tema.edit');
	Route::put('admin/temas/{tema}','admin\ThemeController@update')->name('tema.update');
	Route::get('admin/temas/create','admin\ThemeController@create')->name('tema.create');
	Route::post('admin/temas','admin\ThemeController@store')->name('tema.store');

	//CRUD artículos, las rutas se crean en admin/articulos
	Route::resource('admin/articulos','admin\ArticleController');
	//Ruta para eliminar imagenes
	Route::get('admin/imagenes/{imagen}','admin\ArticleImageController@destroy')->name('imagen.delete');

		
	Route::resource('admin/usuarios','admin\UserController')->only(['index','edit','update']);
});
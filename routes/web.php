<?php

use GuzzleHttp\Middleware;


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

Auth::routes(['verify' => true]);
Route::get('/', 'HomeController@inicio')->name('home');
Route::get('/home', 'HomeController@inicio')->name('home');
Route::get('/anuncios', 'HomeController@index')->name('anuncios');
Route::get('/filtro', 'HomeController@filtros')->name('filtro');


Route::group(['middleware' => ['verified']], function () {
    //usuario-vendedor crud Anuncio
    Route::get('vendedor/Mis-Anuncios', 'AnuncioController@misAnuncios')->name('misAnuncios');
    Route::post('vendedor/Mis-Anuncios/filtro', 'AnuncioController@filtroMisAnuncios')->name('filtroMisAnuncios');
    Route::get('comprador/Mis-Compras', 'AnuncioController@listacompras')->name('misCompras');
    Route::resource('vendedor', 'AnuncioController');

    #   Compradores: Filtrar búsquedas de productos
    Route::get('anuncios/filtros', 'AnuncioController@filtros')->name('filtros');
    Route::resource('comprador', 'AnuncioController');
    #   Transacciones
    Route::post('transaccion/{id}', 'CategoriaController@update') ->name('opinion');
    Route::resource('transaccion', 'TransaccionController');
});
#   Administrador: Editar usuario
Route::group(['middleware' => ['admin']], function () {
    Route::get('users/listado-mejores-vendedores', 'UserController@listado1')->name('listado1');
    Route::get('users/listado-por-categorias', 'UserController@listadocat')->name('listado2');
    Route::get('users/listado-mejores-valorados', 'UserController@listado3')->name('listado3');
    Route::post('users/listado-por-categorias/filtro', 'UserController@listado2')->name('filtrolista2');
    Route::resource('users', 'UserController');
});
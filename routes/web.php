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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('cliente', 'ClienteController');

Route::resource('produto', 'ProdutoController');

Route::get('/nota/{cliente_id}', 'NotaController@index');

Route::get('/nota/create/{cliente_id}', 'NotaController@create');

Route::post('/nota', 'NotaController@store');

Route::get('/relatorio', 'RelatorioController@index')->name('relatorio.index');

Route::post('/relatorio', 'RelatorioController@download')->name('relatorio.download');

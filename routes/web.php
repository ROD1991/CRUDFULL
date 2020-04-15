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
    return view('contenido/contenido');
});

Route::get('movimiento', 'MovimientoController@index');
        Route::post('/movi/regis','MovimientoController@store');
        Route::get('/movimiento/listarPdf/{buscar}','MovimientoController@listarPdf')->name('movi_pdf');
        Route::get('/exportar', 'ExcelController@export');
        Route::put('/date/edit', 'MovimientoController@update');
        Route::put('/date/desac', 'MovimientoController@desactivar');
        Route::put('/date/act', 'MovimientoController@activar');
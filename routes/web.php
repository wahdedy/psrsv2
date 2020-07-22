<?php

use Illuminate\Support\Facades\Route;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');

/*
Route::get('/user', 'UserController@index');
Route::get('/user-register', 'UserController@create');
Route::post('/user-register', 'UserController@store');
Route::get('/user-edit/{id}', 'UserController@edit');
*/

Route::resource('user', 'UserController');

Route::get('/mesinro', 'MesinroController@index')->name('mesinro.index');
Route::post('/mesinro', 'MesinroController@store')->name('mesinro.store');
Route::get('/mesinro/create', 'MesinroController@create')->name('mesinro.create');
Route::get('/mesinro/{id}/edit', 'MesinroController@edit')->name('mesinro.edit');
Route::put('/mesinro/update/{id}', 'MesinroController@update');
Route::get('/mesinro/{id}', 'MesinroController@destroy')->name('mesinro.destroy');
Route::get('/format_mesinro', 'MesinroController@format');
Route::post('/import_mesinro', 'MesinroController@import');
Route::post('/mesinro/import_excel', 'MesinroController@import_excel');


Route::get('/laporan/mesinro', 'LaporanController@mesinro')->name('laporan.mesinro');
Route::get('/laporan/mesinro/excel', 'LaporanController@MesinroExcel');
Route::get('/laporan/cari','LaporanController@cari');
Route::resource('ajaxLaporan','LaporanController');
Route::get('/laporan/export_excel', 'LaporanController@export_excel');
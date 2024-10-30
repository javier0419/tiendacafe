<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('plantilla');
});

Route::get('/menu',\App\Livewire\CatalogoCafe::class)->name('catalogo.cafe');  

Route::get('/plantilla', function () {
    return view('plantilla');
});

Route::get('/welcome', function () {
    return view('welcome');
});

//ruta del carrito
Route::post('/agregar-al-carrito', 
'CarritoController@agregarAlCarrito')->name('agregar.al.carrito');

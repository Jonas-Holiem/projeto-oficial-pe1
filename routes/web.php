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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/', function () {
    return view('home'); // Retorna a view home.blade.php
})->name('home');

use App\Http\Controllers\CardapioController;

Route::get('/cardapio', [CardapioController::class, 'index'])->name('cardapio');


use App\Http\Controllers\PizzasController;

Route::get('/pizzas', [PizzasController::class, 'index'])->name('pizzas');


use App\Http\Controllers\HamburgueresController;

Route::get('/hamburgueres', [HamburgueresController::class, 'index'])->name('hamburgueres');


use App\Http\Controllers\SushisController;

Route::get('/sushis', [SushisController::class, 'index'])->name('sushis');


use App\Http\Controllers\ContatoController;

Route::get('/contato', [ContatoController::class, 'showForm'])->name('contato');
Route::post('/contato', [ContatoController::class, 'sendMessage'])->name('contato.enviar');

use App\Livewire\SobreNos;

Route::get('/sobre-nos', SobreNos::class)->name('sobre-nos');







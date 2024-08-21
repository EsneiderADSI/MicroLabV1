<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', function () { return view('home'); });

Route::get('/modulos', [HomeController::class, 'modulos'])->name('modulos');

Route::get('/modulos/modulo-1', [HomeController::class, 'modulo1'])->name('modulo1');

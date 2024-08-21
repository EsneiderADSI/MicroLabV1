<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', function () { return view('home-two'); });

Route::get('/modulos', [HomeController::class, 'modulos'])->name('modulos');

Route::get('/modulos/modulo-1', [HomeController::class, 'modulo1'])->name('modulo1');

Route::get('/banner', [HomeController::class, 'homebanner'])->name('homebanner');

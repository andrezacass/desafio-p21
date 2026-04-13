<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartorioController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cartorios', CartorioController::class)->except(['show']);



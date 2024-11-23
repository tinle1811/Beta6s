<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('user.home.index');
Route::get('/about', [HomeController::class, 'about'])->name('user.home.about');

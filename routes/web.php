<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;

Route::get('/', [HomeController::class, 'index'])->name('user.home.index');
Route::get('/about', [HomeController::class, 'about'])->name('user.home.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('user.home.contact');

Route::get('/blog',[BlogController::class,'index'])->name('user.blog.index');

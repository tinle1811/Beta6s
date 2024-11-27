<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccountController;

Route::get('/', [HomeController::class, 'index'])->name('user.home.index');
Route::get('/about', [HomeController::class, 'about'])->name('user.home.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('user.home.contact');

Route::get('/blog',[BlogController::class,'index'])->name('user.blog.index');
Route::get('/blog-detail',[BlogController::class,'show'])->name('user.blog.show');

Route::get('/cart',[CartController::class,'index'])->name('user.cart.index');
Route::get('/checkout',[CartController::class,'checkout'])->name('user.cart.checkout');

Route::get('/account',[AccountController::class,'index'])->name('user.account.index');
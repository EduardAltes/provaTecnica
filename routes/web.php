<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['correctUser'])->group(function () {
    Route::get('/menu', function () {
        return view('menu');
    })->name('menu');
    
    Route::resource('categories', CategoryController::class);
    
    Route::resource('products', ProductController::class);
});



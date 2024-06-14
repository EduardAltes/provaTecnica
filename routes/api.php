<?php

use App\Http\Controllers\Api\LoginAPIController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CalendarAPIController;
use App\Http\Controllers\Api\ProductAPIController;
use App\Http\Controllers\Api\CategoryAPIController;

Route::post('/', [LoginAPIController::class, 'login'])->name('submit');

Route::middleware('auth:sanctum')->group(function () {
    
    Route::resource('categories', CategoryAPIController::class);
    
    Route::resource('products', ProductAPIController::class);

    Route::resource('calendar', CalendarAPIController::class);

});

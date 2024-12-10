<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('products')->controller(ProductController::class)->group(function(){
    Route::get('/', 'index')->name('products.index');
    Route::post('/', 'store')->name('products.store');
    Route::get('/create', 'create')->name('products.create');
    Route::get('/{product}', 'show')->name('products.show');
    Route::match(['put', 'patch'], '{product}', 'update')->name('products.update');
    Route::delete('/{product}', 'destroy')->name('products.destroy');
    Route::get('/{product}/edit', 'edit')->name('products.edit');
});

Route::prefix('categories')->controller(CategoryController::class)->group(function(){
    Route::get('/', 'index')->name('categories.index');
    Route::post('/', 'store')->name('categories.store');
    Route::get('/create', 'create')->name('categories.create');
    Route::get('/{category}', 'show')->name('categories.show');
    Route::patch('/{category}', 'update')->name('categories.update');
    Route::delete('/{category}', 'destroy')->name('categories.destroy');
    Route::get('/{category}/edit', 'edit')->name('categories.edit');
});
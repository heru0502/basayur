<?php

use Illuminate\Support\Facades\Route;

Route::domain('admin.' . env('APP_URL'))->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware(['auth:sanctum', 'verified'])->group(function() {
        Route::get('/menus', \App\Http\Livewire\Admin\Menu\Index::class)->name('menus.index');
        Route::get('/menus/create', \App\Http\Livewire\Admin\Menu\Create::class)->name('menus.create');
    });
});

Route::domain('driver.' . env('APP_URL'))->group(function () {
    Route::get('/', function () {
        return 'driver';
    });
});

Route::get('/', \App\Http\Livewire\Home::class);
Route::get('/orders', \App\Http\Livewire\OrderIndex::class);
Route::get('/order-histories', \App\Http\Livewire\OrderHistoryIndex::class);
Route::get('/order-detail', \App\Http\Livewire\OrderDetail::class);
Route::get('/cart', \App\Http\Livewire\Cart::class);
Route::get('/checkout', \App\Http\Livewire\Checkout::class);
Route::get('/payment-method', \App\Http\Livewire\PaymentMethod::class);
Route::get('/search', \App\Http\Livewire\Search::class);
Route::get('/account', \App\Http\Livewire\Account::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

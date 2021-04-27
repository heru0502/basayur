<?php

use Illuminate\Support\Facades\Route;

//Route::livewire('/', 'home')->name('home');
//Route::livewire('/products', 'product-index')->name('product.index');

Route::get('/', \App\Http\Livewire\Home::class);
Route::get('/orders', \App\Http\Livewire\OrderIndex::class);
Route::get('/order-histories', \App\Http\Livewire\OrderHistoryIndex::class);
Route::get('/order-detail', \App\Http\Livewire\OrderDetail::class);
Route::get('/cart', \App\Http\Livewire\Cart::class);
Route::get('/checkout', \App\Http\Livewire\Checkout::class);
Route::get('/payment-method', \App\Http\Livewire\PaymentMethod::class);
Route::get('/search', \App\Http\Livewire\Search::class);

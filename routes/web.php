<?php

use Illuminate\Support\Facades\Route;

//Route::livewire('/', 'home')->name('home');
//Route::livewire('/products', 'product-index')->name('product.index');

Route::get('/', \App\Http\Livewire\Home::class);
Route::get('/products', \App\Http\Livewire\ProductIndex::class);

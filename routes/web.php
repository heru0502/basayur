<?php

use App\Http\Controllers\Customer\AuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware(['auth:sanctum', 'verified'])->group(function() {
        Route::get('/menus', \App\Http\Livewire\Admin\Menu\Index::class)->name('admin.menus.index');
        Route::get('/menus/create', \App\Http\Livewire\Admin\Menu\Create::class)->name('admin.menus.create');
        Route::get('/menus/{id}/edit', \App\Http\Livewire\Admin\Menu\Edit::class)->name('admin.menus.edit');
    });
});
//
//Route::domain('driver.' . env('APP_URL'))->group(function () {
//    Route::get('/', function () {
//        return 'driver';
//    });
//});

Route::get('/', \App\Http\Livewire\Home::class)->name('home');
Route::get('/welcome', \App\Http\Livewire\Welcome::class)->name('welcome');
Route::get('/orders', \App\Http\Livewire\OrderIndex::class)->name('order');
Route::get('/order-histories', \App\Http\Livewire\OrderHistoryIndex::class);
Route::get('/order-detail', \App\Http\Livewire\OrderDetail::class);
Route::get('/cart', \App\Http\Livewire\Cart::class);
Route::get('/checkout', \App\Http\Livewire\Checkout::class);
Route::get('/address', \App\Http\Livewire\AddressUpdate::class);
Route::get('/payment-method', \App\Http\Livewire\PaymentMethod::class);
Route::get('/search', \App\Http\Livewire\Search::class)->name('search');
Route::get('/account', \App\Http\Livewire\Account::class)->name('account');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/auth/{provider}/redirect', function ($provider) {
    $providers = ['google', 'facebook'];

    if (!in_array($provider, $providers))
        abort(404);

    return Socialite::driver($provider)->redirect();
});

Route::get('auth/{provider}/callback', [AuthController::class, 'callbackOAuth']);
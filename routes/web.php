<?php

use App\Http\Controllers\Customer\AuthController;
use Illuminate\Support\Facades\Cookie;
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

//Route::get('/', \App\Http\Livewire\Home::class)->name('home');
//Route::get('/menus', \App\Http\Livewire\MenuIndex::class)->name('menus');
//Route::get('/welcome', \App\Http\Livewire\Welcome::class)->name('welcome');
//Route::get('/orders', \App\Http\Livewire\OrderIndex::class)->name('order');
//Route::get('/order-histories', \App\Http\Livewire\OrderHistoryIndex::class);
//Route::get('/order-detail', \App\Http\Livewire\OrderDetail::class);
//Route::get('/cart', \App\Http\Livewire\Cart::class);
//Route::get('/checkout', \App\Http\Livewire\Checkout::class);
//Route::get('/payment-method', \App\Http\Livewire\PaymentMethod::class);
//Route::get('/search', \App\Http\Livewire\Search::class)->name('search');
//Route::get('/account', \App\Http\Livewire\Account::class)->name('account');

Route::middleware('auth:customer')->group(function() {
//    Route::get('/address', \App\Http\Livewire\AddressUpdate::class);
});

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
Route::post('auth/logout', [AuthController::class, 'logout'])->name('logout-customer');
Route::get('welcome/skip', function() {
    Cookie::queue(Cookie::make('welcome', true, 10080));
    return redirect()->route('home');
});

Route::get('/', [\App\Http\Controllers\Customer\HomeController::class, 'index']);
//Route::get('/orders', [\App\Http\Controllers\Customer\OrderController::class, 'index']);
Route::get('/help', [\App\Http\Controllers\Customer\HelpController::class, 'index']);
Route::get('/cart', [\App\Http\Controllers\Customer\CheckoutController::class, 'cart']);
Route::get('/checkout', [\App\Http\Controllers\Customer\CheckoutController::class, 'checkout']);
Route::get('/voucher', [\App\Http\Controllers\Customer\CheckoutController::class, 'voucher']);
Route::get('/voucher/{id}', [\App\Http\Controllers\Customer\CheckoutController::class, 'voucherShow']);
//Route::get('/address/map', [\App\Http\Controllers\Customer\AddressController::class, 'showMap']);

Route::middleware('auth:customer')->group(function() {
    Route::get('/account', [\App\Http\Controllers\Customer\AccountController::class, 'index']);
    Route::get('/address', [\App\Http\Controllers\Customer\AddressController::class, 'edit']);
    Route::post('/address', [\App\Http\Controllers\Customer\AddressController::class, 'update']);
    Route::get('/select-payment', [\App\Http\Controllers\Customer\CheckoutController::class, 'selectPayment']);
    Route::get('/orders', [\App\Http\Controllers\Customer\OrderController::class, 'index']);
    Route::post('/orders', [\App\Http\Controllers\Customer\OrderController::class, 'store']);
});
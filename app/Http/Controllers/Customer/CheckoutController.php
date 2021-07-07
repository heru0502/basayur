<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function cart()
    {
        return Inertia::render('Cart/Index');
    }

    public function checkout()
    {

    }

    public function selectPayment()
    {

    }
}

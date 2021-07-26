<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddressController extends Controller
{
    public function edit()
    {
        return Inertia::render('Address/Edit');
    }
}

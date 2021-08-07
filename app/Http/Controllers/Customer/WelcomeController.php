<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index($event)
    {
        return Inertia::render('Welcome/Index', ['event' => $event]);
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home/Index', [
            'newestMenus' => Menu::with('unit')
                ->where('is_active', 1)
                ->latest()->get(),
            'popularMenus' => Menu::with('unit')
                ->where('is_active', 1)
                ->oldest()->get(),
        ]);
    }
}

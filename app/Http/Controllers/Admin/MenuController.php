<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function index()
    {
        Inertia::setRootView('layouts/admin-inertia');

        return Inertia::render('Admin/Menu/Index');
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function index(MenuService $menuService)
    {
        return Inertia::render('Menu/Index', [
            'categories' => MenuCategory::all(),
            'menus' => Inertia::lazy(function(Request $request) use($menuService) {
                return $menuService->all($request->all());
            })
        ]);
    }
}

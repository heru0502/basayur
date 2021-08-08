<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use App\Models\Post;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index(OrderService $orderService)
    {
        Inertia::setRootView('layouts/admin-inertia');

        return Inertia::render('Admin/Order/Index', [
            'orders' => $orderService->all('all')->toArray()
        ]);
    }

}

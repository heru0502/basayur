<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\CustomerOrder;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $orders = CustomerOrder::where('customer_id', Auth::guard('customer')->id())
            ->latest()
            ->get();

        foreach ($orders as $order) {
            $order->delivery_date = $order->created_at->translatedFormat('l, d F Y');


        }

        return Inertia::render('Order/Index', [
            'orders' => $orders
        ]);
    }

    public function show($id, OrderService $orderService)
    {
        $order = $orderService->show($id);
        $statusOrders = $orderService->getStatusOrderCOD($id);

        return Inertia::render('Order/Show', [
            'order' => $order,
            'status_orders' => $statusOrders
        ]);
    }

    public function store(Request $request, OrderService $orderService)
    {
        $validator = Validator::make($request->all(), [
            'order_items' => ['required', 'array', function ($attribute, $value, $fail) use($orderService, &$unavailableMenuIds) {
                $orderItems = $value;
                if (!$orderItems) {
                    $fail('Ada kesalahan');
                }

                $unavailableMenuIds = $orderService->checkStock($orderItems);
                if ($unavailableMenuIds) {
                    $fail('Beberapa item tidak tersedia');
                }
            }],
        ]);

        if ($validator->fails()) {
            $validator->errors()->add(
                'unavailable_menu_ids', $unavailableMenuIds
            );

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $totalOrder = $orderService->countTotalOrder($request->all());

        $orderService->create($request->all(), $totalOrder);

        return redirect()->back();
    }
}

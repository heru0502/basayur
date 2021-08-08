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
    public function index(OrderService $orderService)
    {
        return Inertia::render('Order/Index', [
            'orders' => Inertia::lazy(function(Request $request) use($orderService) {
                return $orderService->all($request->event, Auth::guard('customer')->id());
            })
        ]);
    }

    public function indexHistory(OrderService $orderService)
    {
        return Inertia::render('Order/IndexHistory', [
            'orders' => Inertia::lazy(function(Request $request) use($orderService) {
                return $orderService->all($request->event, Auth::guard('customer')->id());
            })
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

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function cart()
    {
        return Inertia::render('Checkout/Cart');
    }

    public function checkout(Request $request, OrderService $orderService)
    {
        $validator = Validator::make($request->all(), [
            'order_items' => [function ($attribute, $value, $fail) use($orderService, &$unavailableMenuIds) {
                $orderItems = json_decode($value, true);
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

            return redirect('cart')
                ->withErrors($validator)
                ->withInput();
        }

        $data['order_items'] = json_decode($request->order_items, true);

        return Inertia::render('Checkout/Checkout', [
            'total_order' => Inertia::lazy(fn () => $orderService->countTotalOrder($data))
        ]);
    }

    public function selectPayment()
    {
        return Inertia::render('Checkout/SelectPayment');
    }
}

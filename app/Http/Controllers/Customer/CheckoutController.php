<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\Voucher;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'address' => CustomerAddress::where('user_id', Auth::guard('customer')->id())->first(),
            'total_order' => Inertia::lazy(function() use($orderService, $request) {
                $data['order_items'] = json_decode($_GET['order_items'] ?? null, true);
                $data['voucher_id'] = $_GET['voucher_id'] ?? null;
                return $orderService->countTotalOrder($data);
            })
        ]);
    }

    public function selectPayment(Request $request, OrderService $orderService)
    {
        return Inertia::render('Checkout/SelectPayment', [
            'total_order' => Inertia::lazy(function() use($orderService, $request) {
                $data['order_items'] = json_decode($_GET['order_items'] ?? null, true);
                $data['voucher_id'] = $_GET['voucher_id'] ?? null;
                return $orderService->countTotalOrder($data);
            })
        ]);
    }

    public function voucher(Request $request)
    {
        return Inertia::render('Checkout/Voucher', [
            'voucher' => Inertia::lazy(fn () => Voucher::where('code', $request->code)->first())
        ]);
    }

    public function voucherShow($id)
    {
        $voucher = Voucher::find($id);

        return Inertia::render('Checkout/VoucherShow', [
            'voucher' => $voucher,
            'end_at' => $voucher->end_at->format('d M Y')
        ]);
    }
}

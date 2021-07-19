<?php


namespace App\Services;


use App\Models\CustomerOrder;
use App\Models\CustomerOrderItem;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function create(array $data)
    {
        $customerId = Auth::guard('customer')->id();
        $paymentId = $data['payment_id'];
        $subtotal = $data['subtotal'];

        $order = CustomerOrder::create([
            'customer_id' => $customerId,
            'order_number' => $this->generateOrderNumber(),
            'status_order_id' => 1,
            'status_payment_id' => 1,
            'status_delivery_id' => 1,
            'subtotal' => $data['subtotal']
        ]);

        foreach ($data['order_items'] as $orderItem) {
            $menu = Menu::find($orderItem['menu_id']);

            CustomerOrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menu->id,
                'original_price' => $menu->original_price,
                'discount' => $menu->discount,
                'selling_price' => $menu->selling_price,
                'qty' => $orderItem->qty,
                'total_price' => $menu->selling_price * $orderItem['qty'],
                'size_per_unit' => $menu->size_per_unit,
                'unit_id' => $menu->unit_id
            ]);
        }


    }

    private function generateOrderNumber()
    {
        $isOrderExist = 1;

        while ($isOrderExist > 0) {
            $orderNumber = "BS" . date("ym") . str_pad(mt_rand(0,9999), 4, '0', STR_PAD_LEFT);
            $isOrderExist = CustomerOrder::where('order_number', $orderNumber)->get()->count();
        }

        return $orderNumber;
    }

    public function countTotalOrder(array $data)
    {
        $subtotal = 0;
        $deliveryPrice = 0;
        $discountPrice = 0;
        $discountPercentage = 0;
        $grandTotal = 0;

        foreach ($data['order_items'] as $orderItem) {
            $menu = Menu::find($orderItem['menu_id']);
            $qty = $orderItem['qty'];

            $total = $menu->selling_price * $qty;
            $subtotal += $total;
        }

        // If using voucher
        if ( ! empty($data['voucher_id'])) {

        }

        // Delivery
        if ($subtotal < 30000) {
            $deliveryPrice = 10000;
        }

        $grandTotal = $subtotal + $deliveryPrice - $discountPrice;

        return [
            'subtotal' => $subtotal,
            'delivery_price' => $deliveryPrice,
            'discount_price' => $discountPrice,
            'grand_total' => $grandTotal
        ];
    }

    public function checkStock(array $orderItems)
    {
        $orderItems = collect($orderItems);
        $unavailableMenuIds = [];

        foreach ($orderItems as $item) {
            $menu = Menu::where('id', $item['menu_id'])
                ->where('is_active', 1)
                ->first();

            if (!$menu) {
                $unavailableMenuIds[] = $item['menu_id'];
            }
        }

        return $unavailableMenuIds;
    }
}
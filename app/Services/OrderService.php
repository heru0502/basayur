<?php


namespace App\Services;


use App\Models\CustomerAddress;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItem;
use App\Models\Menu;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function all()
    {
        $orders = CustomerOrder::where('customer_id', Auth::guard('customer')->id())
            ->latest()
            ->get();

        foreach ($orders as $order) {
            $order->delivery_date = $order->created_at->addDay()->translatedFormat('l, j F Y');
            $order->created_at_string = $order->created_at->translatedFormat('l, j F Y ~ H.i');

            $statusOrders = array_filter($this->getStatusOrderCOD($order->id), function ($val) {
                if ($val['color'] !== 'bg-white') {
                    return $val;
                }
            });
            $statusOrdersLastIndex = count($statusOrders) -1;
            $order->status_order = $statusOrders[$statusOrdersLastIndex];
        }

        return $orders;
    }

    public function show(int $id)
    {
        $order = CustomerOrder::with(
                'items.menu',
                'items.unit',
                'address.customer',
                'address.village.district.regency.province',
                'payment'
            )
            ->where('id', $id)
            ->first();

        $order->delivery_date = $order->created_at->addDay()->translatedFormat('l, j F Y');
        $order->created_at_string = $order->created_at->translatedFormat('l, j F Y ~ H.i');

        return $order;
    }

    public function create(array $data, array $totalOrder)
    {
        $customerId = Auth::guard('customer')->id();
        $subtotal = $totalOrder['subtotal'];
        $deliveryPrice = $totalOrder['delivery_price'];
        $discountPrice = $totalOrder['discount_price'];
        $grandTotal = $totalOrder['grand_total'];
        $address = CustomerAddress::where('user_id', $customerId)->first();

        $order = CustomerOrder::create([
            'customer_id' => $customerId,
            'order_number' => $this->generateOrderNumber(),
            'status_order_id' => 1,
            'status_payment_id' => 1,
            'status_delivery_id' => 1,
            'voucher_id' => $data['voucher_id'] ?? null,
            'payment_id' => 1,
            'delivery_id' => 1,
            'customer_address_id' => $address->id,
            'note' => $data['note'] ?? null,
            'subtotal' => $subtotal,
            'delivery_price' => $deliveryPrice,
            'discount_price' => $discountPrice,
            'grand_total' => $grandTotal
        ]);

        foreach ($data['order_items'] as $orderItem) {
            $menuId = $orderItem['menu_id'] ?? $orderItem['id'];
            $menu = Menu::find($menuId);

            CustomerOrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menu->id,
                'original_price' => $menu->original_price,
                'discount' => $menu->discount,
                'selling_price' => $menu->selling_price,
                'qty' => $orderItem['qty'],
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
            $menuId = $orderItem['menu_id'] ?? $orderItem['id'];
            $menu = Menu::find($menuId);
            $qty = $orderItem['qty'];

            $total = $menu->selling_price * $qty;
            $subtotal += $total;
        }

        // If using voucher
        if ( ! empty($data['voucher_id'])) {
            $voucher = Voucher::find($data['voucher_id']);
            $percentage = $voucher->percentage;
            $discountPrice = ($subtotal * $percentage) / 100;
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
            $menuId = $item['menu_id'] ?? $item['id'];
            $menu = Menu::where('id', $menuId)
                ->where('is_active', 1)
                ->first();

            if (!$menu) {
                $unavailableMenuIds[] = $menuId;
            }
        }

        return $unavailableMenuIds;
    }

    public function getStatusOrderCOD(int $orderId)
    {
        $order = CustomerOrder::find($orderId);
        $statusOrderId = $order->status_order_id;
        $statusDeliveryId = $order->status_delivery_id;

        $result = [
            [
                'color' => 'bg-white',
                'icon' => 'fa fa-shopping-basket',
                'title' => '-',
                'message' => '-'
            ],
            [
                'color' => 'bg-white',
                'icon' => 'fa fa-people-carry',
                'title' => '-',
                'message' => '-'
            ],
            [
                'color' => 'bg-white',
                'icon' => 'fa fa-truck',
                'title' => '-',
                'message' => '-'
            ],
            [
                'color' => 'bg-white',
                'icon' => 'fa fa-check',
                'title' => '-',
                'message' => '-'
            ],
        ];

        if (in_array($statusOrderId, [1,2,3,4]) && in_array($statusDeliveryId, [1,2,3,4])) {
            $result[0] = [
                'color' => 'bg-green-light',
                'icon' => 'fa fa-shopping-basket',
                'title' => 'Pesanan Aktif',
                'message' => 'Pesanan sudah dicatat dan akan diproses pada pukul 23.00'
            ];
        }

        if (in_array($statusOrderId, [2,3,4]) && in_array($statusDeliveryId, [1,2,3,4])) {
            $result[1] = [
                'color' => 'bg-yellow-light',
                'icon' => 'fa fa-people-carry',
                'title' => 'Diproses',
                'message' => 'Pesanan kamu sedang kami siapkan'
            ];
        }

        if (in_array($statusOrderId, [2,3,4]) && in_array($statusDeliveryId, [2,3,4])) {
            $result[1] = [
                'color' => 'bg-green-light',
                'icon' => 'fa fa-people-carry',
                'title' => 'Selesai Dikemas',
                'message' => 'Pesanan selesa dikemas'
            ];
        }

        if (in_array($statusOrderId, [2,3,4]) && $statusDeliveryId === 2) {
            $result[2] = [
                'color' => 'bg-yellow-light',
                'icon' => 'fa fa-truck',
                'title' => 'Driver Sedang OTW',
                'message' => 'Siap-siap ya, kurir kami sedang dalam perjalanan mengatarkan pesanan kamu'
            ];
        }

        if ($statusDeliveryId === 3) {
            $result[2] = [
                'color' => 'bg-red-light',
                'icon' => 'fa fa-truck',
                'title' => 'Pengantaran Gagal',
                'message' => 'Maaf pesanan gagal dikirimkan kurir kami'
            ];
        }

        if ($statusDeliveryId === 4) {
            $result[2] = [
                'color' => 'bg-green-light',
                'icon' => 'fa fa-truck',
                'title' => 'Pesanan Diterima',
                'message' => 'Pesanan telah diterima pelanggan'
            ];
        }

        if ($statusOrderId === 3 && $statusDeliveryId === 3) {
            $result[3] = [
                'color' => 'bg-red-light',
                'icon' => 'fa fa-times',
                'title' => 'Pesanan Batal',
                'message' => 'Pesanan telah dibatalkan'
            ];
        }

        if ($statusOrderId === 4 && $statusDeliveryId === 4) {
            $result[3] = [
                'color' => 'bg-green-light',
                'icon' => 'fa fa-check',
                'title' => 'Pesanan Selesai',
                'message' => 'Selamat menikmati'
            ];
        }

        return $result;
    }
}
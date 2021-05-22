<?php


namespace App\Traits;


use Illuminate\Http\Request;

trait WithCart
{
    public $items;

    public function mountWithCart(Request $request)
    {
        $this->items = $request->session()->get('items');
    }

    public function increase($id)
    {
        $buy_number = $this->items[$id]['buy_number'] ?? 0;

        $this->items[$id]['buy_number'] = $buy_number + 1;

        $this->updateTotalItem();

        session(['items' => $this->items]);
    }

    public function decrease($id)
    {
        $buy_number = $this->items[$id]['buy_number'] ?? 0;

        if ($buy_number > 0) {
            $this->items[$id]['buy_number'] = $buy_number - 1;

            $this->updateTotalItem();

            session(['items' => $this->items]);
        }
    }

    public function updateTotalItem()
    {
        $total_item = 0;
        foreach ($this->items as $item) {
            if (isset($item['buy_number'])) {
                $total_item = $total_item + $item['buy_number'];
            }
        }
        $this->items['total_item'] = $total_item;

        $this->emit('updateCartNumber', $total_item);
    }
}
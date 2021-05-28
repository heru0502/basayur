<?php


namespace App\Traits;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

trait WithCart
{
    public $items = [];
    public $total_item;
    public $last;

    public function mountWithCart(Request $request)
    {
        $this->items = $request->session()->get('items');
        $this->total_item = $request->session()->get('total_item');
//        Session::flush();
    }

    public function increase($menu)
    {
        $menu = collect($menu);
        $items = collect($this->items);
        $item = $items->where('id', $menu->get('id'))->first();

        if ($item) {
            $item = collect($item);
            $id = $item->get('id');
            $buy_number = $item->get('buy_number') + 1;
            $menu->put('buy_number', $buy_number);
            $items->each(function($item, $key) use($id, $buy_number) {
                if ($item['id'] == $id) {
                    $this->items[$key]['buy_number'] = $item['buy_number'] + 1;
                    return false;
                }
            });
        }
        else {
            $menu->put('buy_number', 1);
            array_push($this->items, $menu->toArray());
        }

        $this->updateTotalItem();

        session(['items' => $this->items]);
    }

    public function decrease($id)
    {
        $buy_number = $this->items[$id]['buy_number'] ?? 0;

        if ($buy_number > 0) {
            $buy_number = $buy_number - 1;
            $this->items[$id]['buy_number'] = $buy_number;

            $this->updateTotalItem();

            if ($buy_number > 0) {
                session(['items' => $this->items]);
            } else {
                Session::forget('items.'.$id);
            }
        }
    }

    private function updateTotalItem()
    {
        $total_item = 0;
        foreach ($this->items as $item) {
            if (isset($item['buy_number'])) {
                $total_item = $total_item + $item['buy_number'];
            }
        }

        $this->total_item = $total_item;

        session(['total_item' => $total_item]);
    }
}
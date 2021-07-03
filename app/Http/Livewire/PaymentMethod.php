<?php

namespace App\Http\Livewire;

use App\Traits\WithCart;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class PaymentMethod extends Component
{
    use WithCart;

    protected $rules = [

    ];

    public function mount()
    {
        if (!Session::get('items')) {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.payment-method')
            ->layout('layouts.app-header', ['title' => 'Metode Pembayaran']);
    }

    public function createOrder()
    {
        $items = $this->items;

        if (empty($items))
            abort(400);



        foreach ($items as $item) {

        }
    }
}

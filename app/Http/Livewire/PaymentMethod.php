<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PaymentMethod extends Component
{
    public function render()
    {
        return view('livewire.payment-method')
            ->layout('layouts.app-header', ['title' => 'Metode Pembayaran']);
    }
}

<?php

namespace App\Http\Livewire;

use App\Traits\WithCart;
use Livewire\Component;

class Cart extends Component
{
    use WithCart;

    public function render()
    {
        return view('livewire.cart')
            ->layout('layouts.customer');
    }
}

<?php

namespace App\Http\Livewire;

use App\Traits\WithCart;
use Livewire\Component;

class Cart extends Component
{
    use WithCart;

    public function render()
    {
        $title = 'Cart';

        return view('livewire.cart', compact('title'))
            ->layout('layouts.customer');
    }
}

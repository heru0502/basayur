<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public function render()
    {
        $title = 'Cart';

        return view('livewire.cart', compact('title'))
            ->layout('layouts.customer');
    }
}

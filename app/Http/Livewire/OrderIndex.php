<?php

namespace App\Http\Livewire;

use App\Traits\WithCart;
use Livewire\Component;

class OrderIndex extends Component
{
    use WithCart;

    public function render()
    {
        return view('livewire.order-index')
            ->layout('layouts.customer');
    }
}

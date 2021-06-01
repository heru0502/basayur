<?php

namespace App\Http\Livewire;

use App\Traits\WithCart;
use App\Traits\WithPublic;
use Livewire\Component;

class OrderIndex extends Component
{
    use WithCart, WithPublic;

    public function render()
    {
        return view('livewire.order-index')
            ->layout('layouts.customer');
    }
}

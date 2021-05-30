<?php

namespace App\Http\Livewire;

use App\Traits\WithCart;
use Livewire\Component;

class Account extends Component
{
    use WithCart;

    public function render()
    {
        return view('livewire.account')
            ->layout('layouts.customer');
    }
}

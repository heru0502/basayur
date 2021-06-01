<?php

namespace App\Http\Livewire;

use App\Traits\WithCart;
use App\Traits\WithPublic;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Account extends Component
{
    use WithCart, WithPublic;

    public function render()
    {
        $customer = Auth::guard('customer')->user();

        return view('livewire.account', compact('customer'))
            ->layout('layouts.customer');
    }
}

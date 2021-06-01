<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Welcome extends Component
{
    public function mount()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->to('/');
        }
    }

    public function render()
    {
        return view('livewire.welcome')
            ->layout('layouts.customer');
    }
}

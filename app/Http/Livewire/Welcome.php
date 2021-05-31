<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Welcome extends Component
{
    public function mount()
    {
//        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
//        }
    }

    public function render()
    {
        return view('livewire.welcome')
            ->layout('layouts.customer');
    }
}
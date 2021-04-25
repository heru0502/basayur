<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrderDetail extends Component
{
    public function render()
    {
        return view('livewire.order-detail')
            ->layout('layouts.app-header', ['title' => 'Detail Order']);
    }
}

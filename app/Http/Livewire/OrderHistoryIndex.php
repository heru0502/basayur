<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrderHistoryIndex extends Component
{
    public function render()
    {
        return view('livewire.order-history-index')
            ->layout('layouts.app-header', ['title' => 'Riwayat Order']);
    }
}

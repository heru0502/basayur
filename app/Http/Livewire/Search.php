<?php

namespace App\Http\Livewire;

use App\Traits\WithCart;
use Livewire\Component;

class Search extends Component
{
    use WithCart;

    public function render()
    {
        return view('livewire.search')
            ->layout('layouts.customer');
    }
}

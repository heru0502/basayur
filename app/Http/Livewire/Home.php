<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Traits\WithCart;
use App\Traits\WithModalMenu;
use Livewire\Component;

class Home extends Component
{
    use WithCart, WithModalMenu;

    public function render()
    {
        $menus = Menu::latest()->get();

        return view('livewire.home', compact('menus'))
            ->layout('layouts.customer', ['total_item' => $this->total_item]);
    }
}

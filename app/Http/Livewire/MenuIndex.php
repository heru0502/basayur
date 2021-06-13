<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Traits\WithCart;
use App\Traits\WithModalMenu;
use Livewire\Component;

class MenuIndex extends Component
{
    use WithCart, WithModalMenu;

    public function render()
    {
        $categories = MenuCategory::all();
        $menus = Menu::with('unit')->latest()->get();

        return view('livewire.menu-index', compact('categories', 'menus'))
            ->layout('layouts.customer');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Livewire\Component;

class Home extends Component
{
    public $selected_menu;
//    protected $listeners = ['selected'];

    public function mount()
    {
        $this->selected_menu['in_stock'] = false;
    }

    public function render()
    {
        $menus = Menu::latest()->get();

        return view('livewire.home', compact('menus'))
            ->layout('layouts.customer');
    }

    public function selected($menu)
    {
        $this->selected_menu = $menu ?? '';
//        $this->render();
    }
}

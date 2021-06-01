<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Traits\WithCart;
use App\Traits\WithModalMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Home extends Component
{
    use WithCart, WithModalMenu;

    public function mount()
    {
        $welcome = Cookie::get('welcome');

        if (!$welcome && !Auth::guard('customer')->check()) {
            return redirect()->to('/welcome');
        }
    }

    public function render()
    {
        $menus = Menu::with('unit')->latest()->get();

        return view('livewire.home', compact('menus'))
            ->layout('layouts.customer', ['total_item' => $this->total_item]);
    }
}

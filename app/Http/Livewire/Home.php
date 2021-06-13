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
        $menus['latest'] = Menu::with('unit')
            ->take(10)
            ->latest()
            ->get();

        $menus['promo'] = Menu::with('unit')
            ->where('selling_price', '>', 0)
            ->take(10)
            ->latest()
            ->get();

        return view('livewire.home', compact('menus'))
            ->layout('layouts.customer', ['total_item' => $this->total_item]);
    }
}

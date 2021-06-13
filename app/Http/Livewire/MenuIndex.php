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

    public $selected_categories = [];
    public $selected_filter;

    public function mount()
    {

    }

    public function render()
    {
        $selected_categories = $this->selected_categories;
        $selected_filter = $this->selected_filter;

        $categories = MenuCategory::all();
        $menus = Menu::with('unit')
            ->when(!empty($selected_categories), function($q) use($selected_categories) {
                $q->whereIn('menu_category_id', $selected_categories);
            })
            ->when($selected_filter, function ($q) use ($selected_filter) {
                if ($selected_filter === 'is_promo') {
                    $q->where('special_price', '>', 0);
                }
                else if ($selected_filter === 'is_featured') {
                    $q->where('is_featured', 1);
                }
            })
            ->latest()
            ->get();

        return view('livewire.menu-index', compact('categories', 'menus'))
            ->layout('layouts.customer');
    }

    public function categoryClick($menuId)
    {
        if (in_array($menuId, $this->selected_categories)) {
            $key = array_search($menuId, $this->selected_categories, 'true');
            unset($this->selected_categories[$key]);
        }
        else {
            array_push($this->selected_categories, $menuId);
        }
    }

    public function filterClick($selected_filter)
    {
        if ($this->selected_filter == $selected_filter) {
            $this->selected_filter = null;
        }
        else {
            $this->selected_filter = $selected_filter;
        }
    }
}

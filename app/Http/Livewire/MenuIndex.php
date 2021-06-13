<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Traits\WithCart;
use App\Traits\WithModalMenu;
use Illuminate\Http\Request;
use Livewire\Component;

class MenuIndex extends Component
{
    use WithCart, WithModalMenu;

    public $selected_categories = [];
    public $selected_filter = '';
    public $selected_sorting = '';
    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'selected_categories',
        'selected_filter' => ['except' => ''],
        'selected_sorting' => ['except' => '']
    ];

    public function mount(Request $request)
    {
        $this->selected_categories = $request->selected_categories ?? [];
        $this->selected_filter = $request->selected_filter;
        $this->selected_sorting = 'latest';
    }

    public function render()
    {
        $selected_categories = $this->selected_categories;
        $selected_filter = $this->selected_filter;
        $selected_sorting = $this->selected_sorting;
        $search = $this->search;

        $categories = MenuCategory::all();
        $menus = Menu::with('unit')
            ->when($search, function($q) use($search) {
                $q->where('name', 'like', '%'.$search.'%');
            })
            ->when(!empty($selected_categories), function($q) use($selected_categories) {
                $q->whereIn('menu_category_id', $selected_categories);
            })
            ->when($selected_filter, function ($q) use ($selected_filter) {
                if ($selected_filter === 'is_promo') {
                    $q->where('selling_price', '>', 0);
                }
                else if ($selected_filter === 'is_featured') {
                    $q->where('is_featured', 1);
                }
            })
            ->when($selected_sorting, function($q) use($selected_sorting) {
                if ($selected_sorting === 'latest') {
                    $q->latest();
                }
                else if ($selected_sorting === 'oldest') {
                    $q->oldest();
                }
            })
            ->get();

        return view('livewire.menu-index', compact('categories', 'menus'))
            ->layout('layouts.customer');
    }

    public function categoryClick($menuId)
    {
        if (in_array($menuId, $this->selected_categories)) {
            $key = array_search($menuId, $this->selected_categories);
            unset($this->selected_categories[$key]);
        }
        else {
            array_push($this->selected_categories, $menuId);
        }
    }

    public function filterClick($selected_filter)
    {
        if ($this->selected_filter == $selected_filter) {
            $this->selected_filter = '';
        }
        else {
            $this->selected_filter = $selected_filter;
        }
    }
}

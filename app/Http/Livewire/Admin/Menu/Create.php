<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Unit;
use Livewire\Component;

class Create extends Component
{
    public $in_stock;
    public $post;
    public $menu;

    protected $rules = [
        'menu.name' => 'required|string',
        'menu.description' => 'nullable|string',
        'menu.menu_category_id' => 'required|integer',
        'menu.price' => 'required|integer',
        'menu.special_price' => 'nullable|integer',
        'menu.is_active' => 'boolean',
        'menu.in_stock' => 'boolean',
        'menu.stock' => 'required_if:in_stock,0|integer',
        'menu.size_per_unit' => 'required|integer',
        'menu.unit_id' => 'required|integer',
    ];

    public function mount(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function render()
    {
        $units = Unit::all();
        $categories = MenuCategory::all();

        return view('livewire.admin.menu.create', compact('units', 'categories'))
            ->layoutData(['header_content' => 'Form Tambah Menu']);
    }

    public function inStock()
    {
        $this->in_stock = $this->menu['in_stock'];
    }

    public function save()
    {
        $this->validate();

        $this->menu->save();

        session()->flash('success', 'store');

        return redirect()->to('/menus');
    }
}

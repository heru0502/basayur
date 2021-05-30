<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $in_stock;
    public $menu;
    public $image;

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

    public function updatedPhoto()
    {
        $this->validate([
            'image' => 'image|max:1024',
        ]);
    }

    public function mount(Menu $menu)
    {
        $this->menu = $menu;
        $this->menu['is_active'] = false;
        $this->menu['in_stock'] = false;
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

        $image = $this->image->store('images');

        $this->menu['image'] = 'storage/'. $image;

        $this->menu->save();

        session()->flash('success', 'store');

        return redirect()->to(route('admin.menus.index'));
    }
}

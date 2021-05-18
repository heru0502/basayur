<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $in_stock;
    public $menu;
    public $image;
    public $menu_id;

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

    public function mount($id, Menu $menu)
    {
        $this->menu_id = $id;

        $menu = Menu::find($id);

        $this->menu = $menu;
    }

    public function render()
    {
        $units = Unit::all();
        $categories = MenuCategory::all();
        $menu = Menu::find($this->menu_id);

        return view('livewire.admin.menu.create', compact('units', 'categories', 'menu'))
            ->layoutData(['header_content' => 'Form Tambah Menu']);
    }

    public function inStock()
    {
        $this->in_stock = $this->menu['in_stock'];
    }

    public function save()
    {
        $this->validate();

        if ($this->image) {
            $image = $this->image->store('images');
            $this->menu['image'] = 'storage/'. $image;
        }

        $this->menu->save();

        session()->flash('success', 'update');

        return redirect()->to('/menus');
    }
}

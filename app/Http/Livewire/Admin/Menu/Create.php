<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\MenuCategory;
use App\Models\Unit;
use Livewire\Component;

class Create extends Component
{
    public $is_disabled = true;
    public $in_stock;

    public function render()
    {
        $units = Unit::all();
        $categories = MenuCategory::all();

        return view('livewire.admin.menu.create', compact('units', 'categories'))
            ->layoutData(['header_content' => 'Form Tambah Menu']);
    }

    public function inStock()
    {
//        $this->in_stock = "oke";
    }

    public function save()
    {

    }
}

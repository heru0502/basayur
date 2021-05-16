<?php

namespace App\Http\Livewire\Admin\Menu;

use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        return view('livewire.admin.menu.index')
            ->layoutData(['header_content' => 'Menu']);
    }
}

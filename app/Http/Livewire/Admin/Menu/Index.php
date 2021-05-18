<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\Menu;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['removeAll'];
    public $search = '';
    public $checks = [];

    public function render()
    {
        $menus = Menu::where('name', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.menu.index', compact('menus'))
            ->layoutData(['header_content' => 'Menu']);
    }

    public function countChecked()
    {
        foreach ($this->checks as $key => $check) {
            if ($check == '') {
                unset($this->checks[$key]);
            }
        }
    }

    public function remove()
    {
        $menuIds = array_keys($this->checks);
        $totalChecked = count($this->checks);

        if ($totalChecked > 0) {
            $menus = Menu::find($menuIds)->pluck('name')->toArray();
            $message = implode(', ', $menus);
            $this->emit('sweet-alert', $message);
        }
        else {
            $this->emit('no-selected');
        }
    }

    public function removeAll()
    {
        $menuIds = array_keys($this->checks);
        Menu::destroy($menuIds);
    }
}

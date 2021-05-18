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
    public $check_all;
    public $checks = [];
    public $disabled = false;
    public $total_checked;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(Request $request)
    {
        //
    }

    public function render()
    {
        $menus = Menu::where('name', 'like', '%'.$this->search.'%')->paginate(5);

        return view('livewire.admin.menu.index', compact('menus'))
            ->layoutData(['header_content' => 'Menu']);
    }

//    public function checkAll()
//    {
////        if ($this->check_all) {
//            foreach ($this->checks as $key => $check) {
//                $this->checks[$key] = true;
//            }
////        }
//    }

    public function countChecked()
    {
        foreach ($this->checks as $key => $check) {
            if ($check == '') {
                unset($this->checks[$key]);
            }
        }

        if (count($this->checks) > 0) {
            $this->disabled = true;
        }
    }

    public function remove()
    {
        $menuIds = array_keys($this->checks);
        $totalSelected = count($this->checks);

        if ($totalSelected > 0) {
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

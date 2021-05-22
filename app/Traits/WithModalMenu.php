<?php


namespace App\Traits;


trait WithModalMenu
{
    public $selected_menu;

    public function mountWithModalMenu()
    {
        $this->selected_menu['in_stock'] = false;
    }

    public function selected($menu)
    {
        $this->selected_menu = $menu ?? '';
    }
}
<?php


namespace App\Services;


use App\Models\Menu;

class MenuService
{
    public function all(array $data)
    {
        $categoryIds = json_decode($data['category_ids'] ?? null, true);
        $keyword = $data['keyword'] ?? null;

        $menus = Menu::with('unit')
            ->when($categoryIds, function($q, $categoryIds) {
                $q->whereIn('menu_category_id', $categoryIds);
            })
            ->when($keyword, function($q, $keyword) {
                $q->where('name', 'like', '%'.$keyword.'%');
            })
            ->latest()
            ->get();

        return $menus;
    }
}
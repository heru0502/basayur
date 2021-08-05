<?php


namespace App\Services;


use App\Models\Menu;

class MenuService
{
    public function all(array $data)
    {
        $categoryIds = json_decode($data['category_ids'] ?? null, true);
        $keyword = $data['keyword'] ?? null;
        $event = $data['event'] ?? null;
        $sort = $data['sort'] ?? null;

        $menus = Menu::with('unit')
            ->when($categoryIds, function($q, $categoryIds) {
                $q->whereIn('menu_category_id', $categoryIds);
            })
            ->when($keyword, function($q, $keyword) {
                $q->where('name', 'like', '%'.$keyword.'%');
            })
            ->when($event, function($q, $event) {
                if ($event === 'featured') {
                    $q->where('is_featured', 1);
                }
                else if ($event === 'promo') {
                    $q->where('discount', '>', 0);
                }
            });

        if ($sort === 'latest') {
            $menus = $menus->latest();
        }
        else if ($sort === 'oldest') {
            $menus = $menus->oldest();
        }
        else {
            $menus = $menus->latest();
        }

        return $menus->get();
    }
}
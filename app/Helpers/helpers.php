<?php

function checkBuyButton(int $menu_id, $items)
{
    $items = collect($items);
    $item = $items->where('id', $menu_id)->first();
    $buy_number = $item['buy_number'] ?? 0;

    if ($buy_number < 1) {
        return true;
    } else {
        return false;
    }
}

function getTotalBuyNumber(int $menu_id, $items)
{
    $items = collect($items);
    $item = $items->where('id', $menu_id)->first();
    $buy_number = $item['buy_number'] ?? 0;

    return $buy_number;
}
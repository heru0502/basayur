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

function convertDayEngToInd($day, $string)
{
    $dayInd = '';

    switch ($day) {
        case 'Monday':
            $dayInd = 'Senin'; break;
        case 'Tuesday':
            $dayInd = 'Selasa'; break;
        case 'Wednesday':
            $dayInd = 'Rabu'; break;
        case 'Thursday':
            $dayInd = 'Kamis'; break;
        case 'Friday':
            $dayInd = 'Jumat'; break;
        case 'Saturday':
            $dayInd = 'Sabtu'; break;
        case 'Sunday':
            $dayInd = 'Minggu'; break;
    }

    return str_replace($day, $dayInd, $string);
}

function setStorage()
{
    if (config('app.env') === 'local') {
        return 'public';
    }

    return 's3';
}

function urlImage($image)
{
    if (config('app.env') === 'local') {
        return '/storage/' . $image;
    }

    return 'https://' . config('filesystems.disks.s3.bucket') . '.s3-' . config('filesystems.disks.s3.region') . '.amazonaws.com/' . $image;
}
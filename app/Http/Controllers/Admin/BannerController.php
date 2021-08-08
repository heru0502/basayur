<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Post;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class BannerController extends Controller
{
    public function index()
    {
        Inertia::setRootView('layouts/admin-inertia');

        return Inertia::render('Admin/Banner/Index', [
            'vouchers' => Voucher::all(),
            'posts' => Post::all(),
            'banners' => Banner::all()
        ]);
    }

    public function store(Request $request)
    {
        $banner = Banner::updateOrCreate(
            ['id' => $request->id],
            [
                'voucher_id' => $request->voucher_id,
                'post_id' => $request->post_id,
                'url' => $request->url
            ]
        );

        if ($request->hasFile('image')) {
            $image = Storage::disk(setStorage())->put('images', $request->image);
            $image = urlImage($image);

            $banner->update(['image' => $image]);
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        Banner::destroy($id);

        return redirect()->back();
    }
}

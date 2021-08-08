<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        Inertia::setRootView('layouts/admin-inertia');

        return Inertia::render('Admin/Post/Index', [
            'posts' => Post::select('*', 'content AS post_content')->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        Post::updateOrCreate(
            ['id' => $request->id],
            [
                'title' => $request->title,
                'content' => $request->post_content
            ]
        );

        return redirect()->back();
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->back();
    }
}

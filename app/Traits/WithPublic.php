<?php


namespace App\Traits;


use Illuminate\Support\Facades\Auth;

trait WithPublic
{
    public function mountWithPublic()
    {
        if (Auth::guest()) {
            app('redirect')->setIntendedUrl(url()->current());
        }
    }
}
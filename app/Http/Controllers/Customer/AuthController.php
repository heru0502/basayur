<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function callbackOAuth($provider)
    {
        $user = Socialite::driver('google')->user();
        $providerId = $user->getId();
        $email = $user->getEmail();

        $customer = User::where('email', $email)
            ->orWhere('provider_id', $providerId)
            ->first();

        if (!$customer) {
            $customer = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'provider' => $provider,
                'provider_id' => $user->getId(),
                'profile_photo_path' => $user->getAvatar()
            ]);
        }

        $this->guard->login($customer);

        return redirect(session()->get('url.intended'))->with('success-login', $customer->name);
    }
}

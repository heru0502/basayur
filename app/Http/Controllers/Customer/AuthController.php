<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function callbackOAuth($provider, Request $request)
    {
        try {
            if ($provider === 'facebook') {
                $response = Socialite::driver($provider)->getAccessTokenResponse($request['code']);
                $user = Socialite::driver($provider)->userFromToken($response['access_token']);
            }
            else {
                $user = Socialite::driver('google')->user();
            }

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

            Auth::guard('customer')->login($customer);
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            echo $e->getMessage();
//            abort(400);
        }

        return redirect()->intended('/')->with('success-login', $customer->name);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

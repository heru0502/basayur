<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

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

            $this->guard->login($customer);
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            echo $e->getMessage();
//            abort(400);
        }

        return redirect(session()->get('url.intended') ?? '/')->with('success-login', $customer->name);
    }
}

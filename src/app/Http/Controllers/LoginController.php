<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function requestGoogleLogin()
    {
        /** @var GoogleProvider $driver */
        $driver = Socialite::driver('google');
        return $driver->stateless()->redirect();
    }

    public function callbackGoogleLogin()
    {
        /** @var GoogleProvider $driver */
        $driver = Socialite::driver('google');
        $googleUserData = $driver->stateless()->user();
        $user = Account::query()->updateOrCreate([
            'email' => $googleUserData->getEmail(),
        ] ,[
            'name' => $googleUserData->getName(),
            'profile_img' => $googleUserData->getAvatar(),
        ]);

        Auth::login($user);
        return redirect()->route('home');
    }
}

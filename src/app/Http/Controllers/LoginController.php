<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function requestGoogleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogleLogin()
    {
        $googleUserData = Socialite::driver('google')->user();
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

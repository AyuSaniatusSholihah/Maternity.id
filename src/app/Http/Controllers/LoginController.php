<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        return Socialite::driver('google')->user()->getEmail();
    }
}

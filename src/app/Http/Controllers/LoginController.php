<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

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
        $user = DB::transaction(function () use ($googleUserData) {
            $user = Account::query()->firstOrNew([
                'email' => $googleUserData->getEmail(),
            ]);
            $user->name = $googleUserData->getName();

            if (! $user->exists) {
                $user->role = 'member';
            }

            $user->save();

            if ($user->role === 'member') {
                Member::query()->updateOrCreate(
                    ['account_id' => $user->id],
                    [
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                );
            }

            return $user;
        });

        Auth::guard('web')->login($user);
        request()->session()->regenerate();

        return redirect()->route('home');
    }
}

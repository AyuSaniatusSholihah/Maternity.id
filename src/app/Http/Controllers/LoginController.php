<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function loginWithEmail(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = Account::query()->where('email', $credentials['email'])->first();

        if (! $user || ! $user->password || ! Hash::check($credentials['password'], $user->password)) {
            $message = 'Email atau password salah.';

            return $request->expectsJson()
                ? response()->json(['success' => false, 'message' => $message], 422)
                : back()->withErrors(['email' => $message])->withInput();
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        $redirect = $user->role === 'admin'
            ? route('admin.dashboard')
            : route('home');

        return $request->expectsJson()
            ? response()->json(['success' => true, 'redirect' => $redirect])
            : redirect()->to($redirect);
    }

    public function devLogin(string $id)
    {
        $user = Account::query()->where('email', $id)->firstOrFail();

        Auth::login($user);
        request()->session()->regenerate();

        return redirect()->to($user->role === 'admin' ? route('admin.dashboard') : route('home'));
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

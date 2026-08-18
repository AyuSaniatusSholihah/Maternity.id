<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Maternity.id
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('home');

// Guest & Member Journey Routes
Route::get('/events', function () {
    return view('landing');
})->name('events');

Route::get('/seminars', function () {
    return view('landing');
})->name('seminars.index');

Route::get('/library', function () {
    return view('landing');
})->name('library');

Route::get('/articles', function () {
    return view('landing');
})->name('articles.index');

Route::get('/consult', function () {
    return view('landing');
})->name('consult');

Route::get('/product', function () {
    return view('landing');
})->name('product');

Route::get('/mitra', function () {
    return view('landing');
})->name('mitra.index');

// Member Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('landing');
    })->name('profile.edit');

    Route::get('/my/account', [App\Http\Controllers\MyController::class, 'viewAccount'])->name('my.account');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('/my-subscriptions', function () {
        return view('landing');
    })->name('subscriptions');

    Route::get('/bookmarks', function () {
        return view('landing');
    })->name('bookmarks');

});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/login/google', [LoginController::class, 'requestGoogleLogin'])->name('google.login');
    Route::get('/login/google/callback', [LoginController::class, 'callbackGoogleLogin'])->name('google.callback');

    Route::get('/register', function () {
        return view('auth.login');
    })->name('register');

    Route::get('/auth/google', [LoginController::class, 'requestGoogleLogin'])->name('google.login');
    Route::get('/auth/google/callback', [LoginController::class, 'callbackGoogleLogin']);
});

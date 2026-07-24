<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Maternity.id
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login/google', [LoginController::class, 'requestGoogleLogin'])->name('google.login');
Route::get('/login/google/callback', [LoginController::class, 'callbackGoogleLogin'])->name('google.callback');

Route::get('/auth/google', function () {
    // Nanti disambung ke AuthController@redirectToGoogle
    return redirect()->route('login');
})->name('google.login');

Route::get('/auth/google/callback', function () {
    // Nanti disambung ke AuthController@handleGoogleCallback
    return redirect()->route('home');
})->name('google.callback');

Route::post('/logout', function () {
    // Nanti disambung ke AuthController@logout
    return redirect()->route('home');
})->name('logout');

// Guest & Member Journey Routes (Placeholder Views/Controllers)
Route::get('/seminars', function () {
    return view('welcome'); // gantikan dengan view/controller seminar nantinya
})->name('seminars.index');

Route::get('/library', function () {
    return view('welcome'); // gantikan dengan view/controller library nantinya
})->name('library.index');

Route::get('/articles', function () {
    return view('welcome'); // gantikan dengan view/controller article nantinya
})->name('articles.index');

Route::get('/mitra', function () {
    return view('welcome'); // gantikan dengan view/controller kemitraan nantinya
})->name('mitra.index');

// Member Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('welcome');
    })->name('profile');

    Route::get('/my-subscriptions', function () {
        return view('welcome');
    })->name('subscriptions');

    Route::get('/bookmarks', function () {
        return view('welcome');
    })->name('bookmarks');
});

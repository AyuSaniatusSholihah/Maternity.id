<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\ProductController;
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
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');

Route::get('/seminars', function () {
    return view('landing');
})->name('seminars.index');

Route::get('/library', [EbookController::class, 'index'])->name('library');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/consult', function () {
    return view('landing');
})->name('consult');

Route::get('/product', [ProductController::class, 'index'])->name('product');

Route::get('/mitra', function () {
    return view('landing');
})->name('mitra.index');

// Member Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [MyController::class, 'viewAccount'])->name('profile.edit');
    Route::get('/my/account', [MyController::class, 'viewAccount'])->name('my.account');
    Route::match(['get', 'post'], '/logout', [LogoutController::class, 'logout'])->name('logout');

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

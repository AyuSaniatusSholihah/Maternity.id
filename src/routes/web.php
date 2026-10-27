<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminEventController;
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
Route::get('/events/{slug}/checkout', [EventController::class, 'checkout'])->name('events.checkout');
Route::get('/events/{slug}/verification', [EventController::class, 'verification'])->name('events.verification');
Route::get('/events/{slug}/approved', [EventController::class, 'approved'])->name('events.approved');

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

// Admin Knowledge & Portal Routes
Route::middleware([\App\Http\Middleware\EnsureUserIsAdmin::class])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.home');

    Route::get('/approval', function () {
        return view('admin.dashboard');
    })->name('admin.approval');

    Route::get('/article', function () {
        return view('admin.dashboard');
    })->name('admin.article');

    Route::get('/event', [AdminEventController::class, 'index'])->name('admin.event');
    Route::get('/event/add', [AdminEventController::class, 'create'])->name('admin.event.create');
    Route::get('/event/{slug}/edit', [AdminEventController::class, 'edit'])->name('admin.event.edit');
    Route::post('/event', [AdminEventController::class, 'store'])->name('admin.event.store');
    Route::put('/event/{slug}', [AdminEventController::class, 'update'])->name('admin.event.update');

    Route::get('/ebook', function () {
        return view('admin.dashboard');
    })->name('admin.ebook');
});

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
    Route::post('/login', [LoginController::class, 'loginWithEmail'])->name('login.post');
    Route::get('/login/dev/{id}', [LoginController::class, 'devLogin'])->name('login.dev');
    Route::get('/login/google', [LoginController::class, 'requestGoogleLogin'])->name('google.login');
    Route::get('/login/google/callback', [LoginController::class, 'callbackGoogleLogin'])->name('google.callback');

    Route::get('/register', function () {
        return view('auth.login');
    })->name('register');

    Route::get('/auth/google', [LoginController::class, 'requestGoogleLogin'])->name('google.login');
    Route::get('/auth/google/callback', [LoginController::class, 'callbackGoogleLogin']);
});

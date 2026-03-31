<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. PUBLIC ROUTES (Accessible to everyone)
// ==========================================
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq'); // <-- Add this line
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->name('contact.submit');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/services/{service}', [PublicController::class, 'showService'])->name('public.services.show');
Route::get('/gallery', [\App\Http\Controllers\PublicController::class, 'gallery'])->name('public.gallery');
Route::get('/career', [\App\Http\Controllers\PublicController::class, 'career'])->name('public.career');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// ==========================================
// 2. GUEST ROUTES (Only for non-logged-in users)
// ==========================================
Route::middleware('guest')->group(function () {
    // Registration
    Route::get('/signup', function () { return view('account-pages.signup'); })->name('signup');
    Route::get('/sign-up', [RegisterController::class, 'create'])->name('sign-up');
    Route::post('/sign-up', [RegisterController::class, 'store']);

    // Login
    Route::get('/signin', function () { return view('account-pages.signin'); })->name('signin');
    Route::get('/sign-in', [LoginController::class, 'create'])->name('sign-in');
    Route::post('/sign-in', [LoginController::class, 'store']);

    // Password Reset
    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store']);
});


// ==========================================
// 3. AUTHENTICATED ROUTES (Admin Dashboard Only)
// ==========================================
Route::middleware(['auth', IsAdmin::class])->group(function () {
    
    // Core Dashboard & Logout
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // Custom CMS Routes
    Route::resource('/admin/services', ServiceController::class)->except(['show']);

    // Inbox Routes
    Route::get('/admin/messages', [ContactMessageController::class, 'index'])->name('admin.messages.index');
    Route::delete('/admin/messages/{message}', [ContactMessageController::class, 'destroy'])->name('admin.messages.destroy');
    // FAQ Routes
    Route::resource('/admin/faqs', FaqController::class);
    // Slider Routes
    Route::resource('/admin/sliders', SliderController::class);
    //gALLERY ROUTES
    Route::resource('/admin/galleries', \App\Http\Controllers\Admin\GalleryController::class)->except(['show', 'edit', 'update']);
    // Career Routes
    Route::resource('/admin/careers', \App\Http\Controllers\Admin\CareerController::class)->except(['show', 'edit', 'update']);


    // Settings — single page, just index + update
    Route::get('/admin/settings',  [SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/admin/settings',  [SettingController::class, 'update'])->name('admin.settings.update');

    // Corporate UI Template Default Pages
    Route::get('/tables', function () { return view('tables'); })->name('tables');
    Route::get('/wallet', function () { return view('wallet'); })->name('wallet');
    Route::get('/RTL', function () { return view('RTL'); })->name('RTL');
    Route::get('/profile', function () { return view('account-pages.profile'); })->name('profile');

    // Corporate UI Template User Management
    Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile');
    Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update');
    Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management');

});
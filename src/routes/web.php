<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ContactController::class, 'index']);
Route::post('/contact/confirm', [ContactController::class, 'confirm']);
//Route::post('/contact', [ContactController::class, 'store']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/force-logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();

    return redirect('/login');
});
    Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', function () {
    return view('auth.register'); 
});

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');
    Route::get('/admin/contact/{id}', [AdminController::class, 'show'])->name('admin.contact.show');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
    Route::delete('/admin/contact/{id}', [AdminController::class, 'destroy'])->name('admin.contact.destroy');

    Route::get('/home', function () {
    return view('home'); 
})->name('home');

Route::delete('/admin/contact/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');



});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

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

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Profil Routes
|--------------------------------------------------------------------------
*/
Route::prefix('profil')->group(function () {
    Route::get('/visi-misi', [ProfilController::class, 'visiMisi'])->name('profil.visi-misi');
    Route::get('/prestasi', [ProfilController::class, 'prestasi'])->name('profil.prestasi');
    Route::get('/fasilitas', [ProfilController::class, 'fasilitas'])->name('profil.fasilitas');
});

// Berita routes
Route::get('/berita', function() {
    return view('coming-soon', ['title' => 'Berita']);
})->name('berita');

Route::get('/berita/today', function() {
    return view('coming-soon', ['title' => 'Berita Today']);
})->name('berita.today');

Route::get('/berita/siswa-prestasi', function() {
    return view('coming-soon', ['title' => 'Siswa Prestasi']);
})->name('berita.siswa-prestasi');

Route::get('/berita/agenda', function() {
    return view('coming-soon', ['title' => 'Agenda Sekolah']);
})->name('berita.agenda');

// SPMB route
Route::get('/spmb', function() {
    return view('coming-soon', ['title' => 'SPMB']);
})->name('spmb');

// YouTube API routes
Route::get('/videos/category/{category}', [HomeController::class, 'getVideosByCategory'])->name('videos.category');
Route::post('/refresh-youtube-cache', [HomeController::class, 'refreshYouTubeCache'])->name('youtube.refresh');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Guest routes (hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Logout route (bisa diakses jika sudah login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Dashboard Routes (Protected)
|--------------------------------------------------------------------------
*/

// Dashboard routes - hanya bisa diakses setelah login
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard Home
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    // Content Management Routes
    Route::resource('contents', App\Http\Controllers\Dashboard\ContentController::class);
    
    // User Management Routes (Basic Auth Only)
    Route::resource('users', App\Http\Controllers\Dashboard\UserController::class);
    Route::patch('users/{user}/toggle-status', [App\Http\Controllers\Dashboard\UserController::class, 'toggleStatus'])->name('users.toggle-status');
});

// Alias route untuk dashboard (tanpa prefix)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
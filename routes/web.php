<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

// Profil routes
Route::get('/profil/visi-misi', function() {
    return view('coming-soon', ['title' => 'Visi Misi']);
})->name('profil.visi-misi');

Route::get('/profil/prestasi', function() {
    return view('coming-soon', ['title' => 'Prestasi']);
})->name('profil.prestasi');

Route::get('/profil/fasilitas', function() {
    return view('coming-soon', ['title' => 'Fasilitas']);
})->name('profil.fasilitas');

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

// Additional public routes
Route::get('/tentang', function () {
    return view('coming-soon', ['title' => 'Tentang Sekolah']);
})->name('tentang');

Route::get('/pendaftaran', function () {
    return view('coming-soon', ['title' => 'Pendaftaran']);
})->name('pendaftaran');

Route::get('/program', function () {
    return view('coming-soon', ['title' => 'Program Unggulan']);
})->name('program');

Route::get('/ekstrakurikuler', function () {
    return view('coming-soon', ['title' => 'Ekstrakurikuler']);
})->name('ekstrakurikuler');

Route::get('/konsultasi', function () {
    return view('coming-soon', ['title' => 'Konsultasi']);
})->name('konsultasi');

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
});

// Alias route untuk dashboard (tanpa prefix)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Future CMS Routes (Coming Soon)
|--------------------------------------------------------------------------
| Routes ini akan diimplementasikan di tahap selanjutnya
*/

// Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
//     // Berita Management Routes
//     Route::resource('berita', BeritaController::class);
//     
//     // Galeri Management Routes  
//     Route::resource('galeri', GaleriController::class);
//     
//     // User Management Routes (hanya untuk Super Admin)
//     Route::middleware(['role:super admin'])->group(function () {
//         Route::resource('users', UserController::class);
//     });
// });
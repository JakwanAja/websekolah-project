<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Login route
Route::get('/login', function() {
    return view('coming-soon', ['title' => 'Dashboard Login']);
})->name('login');

// Additional routes yang mungkin dibutuhkan berdasarkan data di HomeController
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
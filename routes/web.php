<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasPayungController;
use App\Http\Controllers\KelasPondokController;
use App\Http\Controllers\PlpBahasaController;
use App\Http\Controllers\PlpItController;
use App\Http\Controllers\PlpKarakterController;
use App\Http\Controllers\PlpTahfidzController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;


// Home
Route::middleware('auth')->get('/', [HomeController::class, 'index']);


// Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->middleware('guest')->name('login');
    Route::post('auth', 'auth')->name('auth');
    Route::get('logout', 'logout')->name('logout');
});


// Santri
Route::middleware('auth')->prefix('santri')->controller(SantriController::class)->name('santri')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::get('profil/{santri}', 'profil')->name('.profil');

    Route::get('bidang', 'bidang')->name('.bidang');
    Route::patch('bidang', 'bidangUpdate')->name('.bidangUpdate')->middleware(['role:admin|kadiv']);

    Route::get('catatan/{santri}', 'catatan')->name('.catatan');
    Route::post('catatan', 'catatanStore')->name('.catatanStore')->middleware(['role:admin|kadiv']);
    Route::patch('catatan', 'catatanUpdate')->name('.catatanUpdate')->middleware(['role:admin|kadiv']);
});


// PLP Tahfidz
Route::middleware(['auth'])->prefix('plp-tahfidz')->controller(PlpTahfidzController::class)->name('plp-tahfidz')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store');
    Route::patch('update', 'update')->name('.update');
    Route::delete('destroy/{plp_tahfidz}', 'destroy')->name('.destroy');
});

// PLP IT
Route::middleware(['auth'])->prefix('plp-it')->controller(PlpItController::class)->name('plp-it')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store');
    Route::patch('update', 'update')->name('.update');
    Route::delete('destroy/{plp_it}', 'destroy')->name('.destroy');
});

// PLP Bahasa
Route::middleware(['auth'])->prefix('plp-bahasa')->controller(PlpBahasaController::class)->name('plp-bahasa')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store');
    Route::patch('update', 'update')->name('.update');
    Route::delete('destroy/{plp_bahasa}', 'destroy')->name('.destroy');
});

// PLP Karakter
Route::middleware(['auth'])->prefix('plp-karakter')->controller(PlpKarakterController::class)->name('plp-karakter')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store');
    Route::patch('update', 'update')->name('.update');
    Route::delete('destroy/{plp_karakter}', 'destroy')->name('.destroy');
});



// Kelas Payung
Route::middleware(['auth'])->prefix('kelas-payung')->controller(KelasPayungController::class)->name('kelas-payung')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store');
    Route::patch('update', 'update')->name('.update');
    Route::delete('destroy/{kelasPayung}', 'destroy')->name('.destroy');
});

// Kelas Pondok
Route::middleware(['auth'])->prefix('kelas-pondok')->controller(KelasPondokController::class)->name('kelas-pondok')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store');
    Route::patch('update', 'update')->name('.update');
    Route::delete('destroy/{kelasPondok}', 'destroy')->name('.destroy');
});


// Siswa
Route::middleware(['auth'])->prefix('siswa')->controller(SiswaController::class)->name('siswa')->group(function () {
    Route::get('/', 'index');
    Route::get('profil/{siswa}', 'profil')->name('.profil');
    Route::get('edit/{siswa}', 'edit')->name('.edit');
    Route::patch('{siswa}', 'update')->name('.update');
    Route::delete('{siswa}', 'destroy')->name('.destroy');
});


// Semester
Route::middleware(['auth'])->prefix('semester')->controller(SemesterController::class)->name('semester')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store');
});


// Fallback
Route::fallback(fn () => redirect()->to('/'));

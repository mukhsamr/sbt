<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasPayungController;
use App\Http\Controllers\KelasPondokController;
use App\Http\Controllers\ParentsController;
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

    Route::get('assigne', 'assigne')->name('.assigne')->middleware(['role:admin|tu']);
    Route::post('assigne', 'assigneStore')->name('.assigne-store')->middleware(['role:admin|tu']);
    Route::patch('assigne', 'assigneUpdate')->name('.assigne-update')->middleware(['role:admin|tu']);
    Route::delete('assigne/{santri}', 'assigneRemove')->name('.assigne-remove')->middleware(['role:admin|tu']);

    Route::get('bidang', 'bidang')->name('.bidang');
    Route::post('bidang', 'bidangStore')->name('.bidangStore')->middleware(['role:admin|kadiv']);
    Route::patch('bidang', 'bidangUpdate')->name('.bidangUpdate')->middleware(['role:admin|kadiv']);

    Route::get('catatan/{santri}', 'catatan')->name('.catatan');
    Route::post('catatan', 'catatanStore')->name('.catatanStore')->middleware(['role:admin|kadiv']);
    Route::patch('catatan', 'catatanUpdate')->name('.catatanUpdate')->middleware(['role:admin|kadiv']);
});


// PLP Tahfidz
Route::middleware(['auth'])->prefix('plp-tahfidz')->controller(PlpTahfidzController::class)->name('plp-tahfidz')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store')->middleware(['role:admin|kadiv']);
    Route::patch('update', 'update')->name('.update')->middleware(['role:admin|kadiv']);
    Route::delete('destroy/{plp_tahfidz}', 'destroy')->name('.destroy')->middleware(['role:admin|kadiv']);
});

// PLP IT
Route::middleware(['auth'])->prefix('plp-it')->controller(PlpItController::class)->name('plp-it')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store')->middleware(['role:admin|kadiv']);
    Route::patch('update', 'update')->name('.update')->middleware(['role:admin|kadiv']);
    Route::delete('destroy/{plp_it}', 'destroy')->name('.destroy')->middleware(['role:admin|kadiv']);
});

// PLP Bahasa
Route::middleware(['auth'])->prefix('plp-bahasa')->controller(PlpBahasaController::class)->name('plp-bahasa')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store')->middleware(['role:admin|kadiv']);
    Route::patch('update', 'update')->name('.update')->middleware(['role:admin|kadiv']);
    Route::delete('destroy/{plp_bahasa}', 'destroy')->name('.destroy')->middleware(['role:admin|kadiv']);
});

// PLP Karakter
Route::middleware(['auth'])->prefix('plp-karakter')->controller(PlpKarakterController::class)->name('plp-karakter')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store')->middleware(['role:admin|kadiv']);
    Route::patch('update', 'update')->name('.update')->middleware(['role:admin|kadiv']);
    Route::delete('destroy/{plp_karakter}', 'destroy')->name('.destroy')->middleware(['role:admin|kadiv']);
});



// Kelas Payung
Route::middleware(['auth'])->prefix('kelas-payung')->controller(KelasPayungController::class)->name('kelas-payung')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store')->middleware(['role:admin|tu']);
    Route::patch('update', 'update')->name('.update')->middleware(['role:admin|tu']);
    Route::delete('destroy/{kelasPayung}', 'destroy')->name('.destroy')->middleware(['role:admin|tu']);
});

// Kelas Pondok
Route::middleware(['auth'])->prefix('kelas-pondok')->controller(KelasPondokController::class)->name('kelas-pondok')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store')->middleware(['role:admin|tu']);
    Route::patch('update', 'update')->name('.update')->middleware(['role:admin|tu']);
    Route::delete('destroy/{kelasPondok}', 'destroy')->name('.destroy')->middleware(['role:admin|tu']);
});


// Siswa
Route::middleware(['auth'])->prefix('siswa')->controller(SiswaController::class)->name('siswa')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::get('profil/{siswa}', 'profil')->name('.profil');
    Route::get('create', 'create')->name('.create')->middleware(['role:admin|tu']);
    Route::get('edit/{siswa}', 'edit')->name('.edit')->middleware(['role:admin|tu']);

    Route::post('/', 'store')->name('.store')->middleware(['role:admin|tu']);
    Route::patch('{siswa}', 'update')->name('.update')->middleware(['role:admin|tu']);
    Route::delete('remove/{siswa}', 'remove')->name('.remove')->middleware(['role:admin|tu']);
    Route::delete('{siswa}', 'destroy')->name('.destroy')->middleware(['role:admin|tu']);
});


// Parents
Route::middleware(['auth'])->prefix('parents')->controller(ParentsController::class)->name('parents')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::get('profil/{parents}', 'profil')->name('.profil');
    Route::get('create', 'create')->name('.create')->middleware(['role:admin|tu']);
    Route::get('edit/{parents}', 'edit')->name('.edit')->middleware(['role:admin|tu']);

    Route::post('/', 'store')->name('.store')->middleware(['role:admin|tu']);
    Route::patch('{parents}', 'update')->name('.update')->middleware(['role:admin|tu']);
    Route::delete('{parents}', 'destroy')->name('.destroy')->middleware(['role:admin|tu']);
});


// Semester
Route::middleware(['auth'])->prefix('semester')->controller(SemesterController::class)->name('semester')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::post('store', 'store')->name('.store');
});


// Fallback
Route::fallback(fn () => redirect()->to('/'));

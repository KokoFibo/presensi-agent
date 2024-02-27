<?php

use App\Livewire\Scan;
use App\Livewire\Leader;
use App\Livewire\GenerateQr;
use App\Livewire\Locationwr;
use App\Livewire\Registration;
use App\Livewire\DaftarPresensi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::get('registration', Registration::class)
    ->middleware(['auth', 'verified'])
    ->name('registration');

Route::get('location', Locationwr::class)
    ->middleware(['auth', 'verified'])
    ->name('location');

Route::get('qrcode', GenerateQr::class)
    ->middleware(['auth', 'verified'])
    ->name('qrcode');

Route::get('scan', Scan::class)
    ->middleware(['auth', 'verified'])
    ->name('scan');

Route::get('presensi', DaftarPresensi::class)
    ->middleware(['auth', 'verified'])
    ->name('presensi');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

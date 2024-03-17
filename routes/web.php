<?php

use App\Livewire\Scan;
use App\Livewire\Leader;
use App\Livewire\GenerateQr;
use App\Livewire\Locationwr;
use App\Livewire\Registration;
use App\Livewire\DaftarPresensi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRCodeController;
use App\Livewire\Scan2;
use App\Livewire\Test;

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

// ini yg livewire
// Route::get('scan', Scan::class)
//     ->middleware(['auth', 'verified'])
//     ->name('scan');



Route::get('presensi', DaftarPresensi::class)
    ->middleware(['auth', 'verified'])
    ->name('presensi');

Route::post('/process-qr-code', [QRCodeController::class, 'processQRCode'])->name('savescan');

Route::get('/scan', [QRCodeController::class, 'index'])->name('scan');

Route::get('/scan2', Scan2::class)->name('scan2');


Route::get('/test', Test::class);

// Route::get('/showqr', function () {
//     return view('showqr');
// })->name('scan2');




Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

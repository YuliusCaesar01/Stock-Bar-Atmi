<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\BarangLogController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/logs', [BarangLogController::class, 'index'])->name('logs');

Route::get('/saldobulanan', function () {
    return view('report.saldobulanan');
})->middleware(['auth'])->name('saldobulanan');

Route::get('/hakaksesgudang', function () {
    return view('setup.hakaksesgudang');
})->middleware(['auth'])->name('hakaksesgudang');

Route::get('/setuptahun', function () {
    return view('setup.setuptahun');
})->middleware(['auth'])->name('setuptahun');

Route::get('/form', function () {
    return view('form.index');
})->middleware(['auth'])->name('form.index');

Route::get('/form/create', function () {
    return view('form.create');
})->middleware(['auth'])->name('form.create');

Route::get('/barangs/tambahbarangbaru', function () {
    return view('barangs.tambahbarangbaru');
})->middleware(['auth'])->name('barangs.tambahbarangbaru');

Route::get('/barangs/view', [BarangController::class, 'view'])->name('barangs.view');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('barangs', BarangController::class);
    Route::post('barangs/{barang}/entry', [BarangController::class, 'entry'])->name('barangs.entry');
    Route::post('barangs/{barang}/exit', [BarangController::class, 'exit'])->name('barangs.exit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/barangs/search', [BarangController::class, 'searchAndExit'])->name('barangs.search');
});

Route::get('/clock', [ClockController::class, 'showClock']);

require __DIR__.'/auth.php';

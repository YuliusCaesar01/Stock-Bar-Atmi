<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangLogController;
use App\Http\Controllers\NamaBarangController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/logs', [BarangLogController::class, 'index'])->name('logs');
Route::get('setup/setupbarang', [NamaBarangController::class, 'index'])->name('setupbarang');
Route::post('/setupbarang', [NamaBarangController::class, 'store'])->name('nama-barang.store');

// Route to display the form to edit an existing item
Route::get('/nama-barang/{id}/edit', [NamaBarangController::class, 'edit'])->name('nama-barang.edit');

// Route to update an existing item
Route::put('/nama-barang/{id}', [NamaBarangController::class, 'update'])->name('nama-barang.update');

// Route to delete an item
Route::delete('/nama-barang/{id}', [NamaBarangController::class, 'destroy'])->name('nama-barang.destroy');


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

Route::get('/get-barang-details/{nama_barang}', [BarangController::class, 'getBarangDetails']);
Route::get('/get-order-items/{order_number}', [BarangController::class, 'getOrderItems']);

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('barangs', BarangController::class);
    Route::post('barangs/entry', [BarangController::class, 'entry'])->name('barangs.entry');
    Route::post('barangs/exit', [BarangController::class, 'exit'])->name('barangs.exit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/barangs/search', [BarangController::class, 'searchAndExit'])->name('barangs.search');
});

Route::get('/clock', [ClockController::class, 'showClock']);

require __DIR__.'/auth.php';

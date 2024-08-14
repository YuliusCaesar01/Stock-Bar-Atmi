<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\BarangLogController;
use App\Http\Controllers\LogGudangController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\MasterAkunController;
use App\Http\Controllers\NamaBarangController;
use App\Http\Controllers\KodeInstitusiController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [BarangController::class, 'dashboard'])->name('dashboard');
Route::get('/logs', [BarangLogController::class, 'index'])->name('logs');
Route::get('setup/setupbarang', [NamaBarangController::class, 'index'])->name('setupbarang');
Route::post('/setupbarang', [NamaBarangController::class, 'store'])->name('nama-barang.store');

// Route to display the form to edit an existing item
Route::get('/nama-barang/{id}/edit', [NamaBarangController::class, 'edit'])->name('nama-barang.edit');

Route::get('nama-barang/create', [NamaBarangController::class, 'create'])->name('nama-barang.create');

// Route to update an existing item
Route::put('/nama-barang/{id}', [NamaBarangController::class, 'update'])->name('nama-barang.update');

// Route to delete an item
Route::delete('/nama-barang/{id}', [NamaBarangController::class, 'destroy'])->name('nama-barang.destroy');

// Setup Satuan
Route::get('setup/setupsatuan', [SatuanController::class, 'index'])->name('setupsatuan');
Route::post('/setupsatuan', [SatuanController::class, 'store'])->name('setupsatuan.store');
Route::get('/setupsatuan/{id}/edit', [SatuanController::class, 'edit'])->name('setupsatuan.edit');
Route::put('/setupsatuan/{id}', [SatuanController::class, 'update'])->name('setupsatuan.update');
Route::delete('/setupsatuan/{id}', [SatuanController::class, 'destroy'])->name('setupsatuan.destroy');

// Setup Log Gudang
Route::get('setup/setuploggudang', [LogGudangController::class, 'index'])->name('setuploggudang');
Route::post('/setuploggudang', [LogGudangController::class, 'store'])->name('setuploggudang.store');
Route::get('/setuploggudang/{id}/edit', [LogGudangController::class, 'edit'])->name('setuploggudang.edit');
Route::put('/setuploggudang/{id}', [LogGudangController::class, 'update'])->name('setuploggudang.update');
Route::delete('/setuploggudang/{id}', [LogGudangController::class, 'destroy'])->name('setuploggudang.destroy');

// Setup Log Produksi
Route::get('setup/setupproduksi', [ProduksiController::class, 'index'])->name('setupproduksi');
Route::post('/setupproduksi', [ProduksiController::class, 'store'])->name('setupproduksi.store');
Route::get('/setupproduksi/{id}/edit', [ProduksiController::class, 'edit'])->name('setupproduksi.edit');
Route::put('/setupproduksi/{id}', [ProduksiController::class, 'update'])->name('setupproduksi.update');
Route::delete('/setupproduksi/{id}', [ProduksiController::class, 'destroy'])->name('setupproduksi.destroy');

// Setup Master Akun
Route::get('setup/setupmasterakun', [MasterAkunController::class, 'index'])->name('setupmasterakun');
Route::post('/setupmasterakun', [MasterAkunController::class, 'store'])->name('setupmasterakun.store');
Route::get('/setupmasterakun/{id}/edit', [MasterAkunController::class, 'edit'])->name('setupmasterakun.edit');
Route::put('/setupmasterakun/{id}', [MasterAkunController::class, 'update'])->name('setupmasterakun.update');
Route::delete('/setupmasterakun/{id}', [MasterAkunController::class, 'destroy'])->name('setupmasterakun.destroy');

// Setup Unit Kerja
Route::get('setup/setupunitkerja', [UnitKerjaController::class, 'index'])->name('setupunitkerja');
Route::post('/setupunitkerja', [UnitKerjaController::class, 'store'])->name('setupunitkerja.store');
Route::get('/setupunitkerja/{id}/edit', [UnitKerjaController::class, 'edit'])->name('setupunitkerja.edit');
Route::put('/setupunitkerja/{id}', [UnitKerjaController::class, 'update'])->name('setupunitkerja.update');
Route::delete('/setupunitkerja/{id}', [UnitKerjaController::class, 'destroy'])->name('setupunitkerja.destroy');

// Setup Institusi
Route::get('setup/setupinstitusi', [KodeInstitusiController::class, 'index'])->name('setupinstitusi');
Route::post('/setupinstitusi', [KodeInstitusiController::class, 'store'])->name('setupinstitusi.store');
Route::get('/setupinstitusi/{id}/edit', [KodeInstitusiController::class, 'edit'])->name('setupinstitusi.edit');
Route::put('/setupinstitusi/{id}', [KodeInstitusiController::class, 'update'])->name('setupinstitusi.update');
Route::delete('/setupinstitusi/{id}', [KodeInstitusiController::class, 'destroy'])->name('setupinstitusi.destroy');


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

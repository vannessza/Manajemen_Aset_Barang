<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\DataAsetController;
use App\Http\Controllers\AsetDetailController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function(){
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']); // Memastikan menggunakan metode POST
});

Route::get('/home', function(){
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/aset', [AsetController::class, 'index'])->name('aset.index');
Route::get('/aset/show/{id}', [AsetController::class, 'show'])->name('aset.show');
Route::get('/aset/show/pinjam/{id}', [PeminjamanController::class, 'createpinjamuser'])->name('aset.pinjam');
// data aset
Route::get('/data aset', [DataAsetController::class, 'index'])->name('dataaset.index');
Route::get('/data aset/create', [DataAsetController::class, 'create'])->name('dataaset.create');
Route::post('/data aset/store', [DataAsetController::class, 'store'])->name('dataaset.store');
Route::get('/data aset/edit/{id}', [DataAsetController::class, 'edit'])->name('dataaset.edit');
Route::patch('/data aset/{id}', [DataAsetController::class, 'update'])->name('dataaset.update');
Route::get('/data aset/delete/{id}', [DataAsetController::class, 'delete'])->name('dataaset.delete');
//detail aset
Route::get('/data aset/detail aset/{id}', [AsetDetailController::class, 'index'])->name('detailaset.index');
Route::get('/data aset/detail aset/create/{id}', [AsetDetailController::class, 'create'])->name('detailaset.create');
Route::post('/data aset/detail aset/store/{id}', [AsetDetailController::class, 'store'])->name('detailaset.store');
Route::post('/data aset/detail aset/show/{id}', [AsetDetailController::class, 'show'])->name('detailaset.show');
Route::get('/data aset/detail aset/{aset}/{asetDetail}/edit', [AsetDetailController::class, 'edit'])->name('detailaset.edit');
Route::patch('/data aset/detail aset/{aset}/{asetDetail}/update', [AsetDetailController::class, 'update'])->name('detailaset.update');
Route::get('/data aset/detail aset/{aset}/{asetDetail}/delete', [AsetDetailController::class, 'delete'])->name('detailaset.delete');
//peminjaman Admin dan super admin
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
Route::get('/peminjaman/show/{id}', [PeminjamanController::class, 'show'])->name('Peminjaman.show');
Route::get('/peminjaman/edit/{id}', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
Route::patch('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
Route::get('/peminjaman/delete/{id}', [PeminjamanController::class, 'delete'])->name('peminjaman.delete');
//pengembalian Admin dan super admin
Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::get('/pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
Route::post('/pengembalian/store', [PengembalianController::class, 'store'])->name('pengembalian.store');
Route::get('/pengembalian/show/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show');
Route::get('/pengembalian/edit/{id}', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
Route::patch('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
Route::get('/pengembalian/delete/{id}', [PengembalianController::class, 'delete'])->name('pengembalian.delete');
//logout
Route::post('/logout', [LoginController::class, 'logout']);
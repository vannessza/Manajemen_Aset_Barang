<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\DataAsetController;
use App\Http\Controllers\AsetDetailController;
use App\Http\Controllers\PeminjamanController;
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
//peminjaman Admin dan super admin
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');

Route::post('/logout', [LoginController::class, 'logout']);
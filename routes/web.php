<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\DataAsetController;
use App\Http\Controllers\AsetDetailController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenghancuranController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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
Route::post('/aset/show/store/{id}', [PeminjamanController::class, 'storepinjamuser'])->name('aset.store');
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
Route::get('/peminjaman/user', [PeminjamanController::class, 'indexuser'])->name('peminjaman.index.user');
Route::get('/peminjaman/user/show{id}', [PeminjamanController::class, 'showuser'])->name('peminjaman.show.user');
Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
Route::get('/peminjaman/show/{id}', [PeminjamanController::class, 'show'])->name('Peminjaman.show');
Route::get('/peminjaman/edit/{id}', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
Route::patch('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
Route::get('/peminjaman/delete/{id}', [PeminjamanController::class, 'delete'])->name('peminjaman.delete');
//pengembalian Admin dan super admin
Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::get('/pengembalian/user', [PengembalianController::class, 'indexuser'])->name('pengembalian.index.user');
Route::get('/pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
Route::get('/pengembalian/user/create', [PengembalianController::class, 'createuser'])->name('pengembalian.create.user');
Route::post('/pengembalian/store', [PengembalianController::class, 'store'])->name('pengembalian.store');
Route::post('/pengembalian/user/store', [PengembalianController::class, 'storeuser'])->name('pengembalian.store.user');
Route::get('/pengembalian/show/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show');
Route::get('/pengembalian/user/show/{id}', [PengembalianController::class, 'showuser'])->name('pengembalian.show.user');
Route::get('/pengembalian/edit/{id}', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
Route::patch('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
Route::get('/pengembalian/delete/{id}', [PengembalianController::class, 'delete'])->name('pengembalian.delete');
//Penghancuran Admin dan Super admin
Route::get('/penghancuran', [PenghancuranController::class, 'index'])->name('penghancuran.index');
Route::get('/penghancuran/create', [PenghancuranController::class, 'create'])->name('penghancuran.create');
Route::post('/penghancuran/store', [PenghancuranController::class, 'store'])->name('penghancuran.store');
Route::get('/penghancuran/delete/{id}', [PenghancuranController::class, 'delete'])->name('penghancuran.delete');
Route::get('/penghancuran/show/{id}', [PenghancuranController::class, 'show'])->name('penghancuran.show');
//Request
Route::get('/request', [RequestController::class, 'index'])->name('request.index');
Route::get('/request/terima peminjaman/{id}', [RequestController::class, 'terimapeminjaman'])->name('request.terima.peminjaman');
Route::patch('/request/terima peminjaman/update/{id}', [RequestController::class, 'terimapeminjamanupdate'])->name('request.update.terima.peminjaman');
Route::get('/request/tolak peminjaman/{id}', [RequestController::class, 'tolakpeminjaman'])->name('request.tolak.peminjaman');
Route::patch('/request/tolak peminjaman/update/{id}', [RequestController::class, 'tolakpeminjamanupdate'])->name('request.update.tolak.peminjaman');
Route::get('/request/peminjaman/show/{id}', [RequestController::class, 'showpeminjaman'])->name('request.show.peminjaman');
Route::get('/request/terima pengembalian/{id}', [RequestController::class, 'terimapengembalian'])->name('request.terima.pengembalian');
Route::patch('/request/terima pengembalian/update/{id}', [RequestController::class, 'terimapengembaliannupdate'])->name('request.update.terima.pengembalian');
Route::get('/request/tolak pengembalian/{id}', [RequestController::class, 'tolakpengembalian'])->name('request.tolak.pengembalian');
Route::patch('/request/tolak pengembalian/update/{id}', [RequestController::class, 'tolakpengembalianupdate'])->name('request.update.tolak.pengembalian');
Route::get('/request/pengembalian/show/{id}', [RequestController::class, 'showpengembalian'])->name('request.show.pengembalian');
Route::get('/request/terima penghancuran/{id}', [RequestController::class, 'terimapenghancuran'])->name('request.terima.penghancuran');
Route::patch('/request/terima penghancuran/update/{id}', [RequestController::class, 'terimapenghancuranupdate'])->name('request.update.terima.penghancuran');
Route::get('/request/tolak penghancuran/{id}', [RequestController::class, 'tolakpenghancuran'])->name('request.tolak.penghancuran');
Route::patch('/request/tolak penghancuran/update/{id}', [RequestController::class, 'tolakpenghancuranupdate'])->name('request.update.tolak.penghancuran');
Route::get('/request/penghancuran/show/{id}', [RequestController::class, 'showpenghancuran'])->name('request.show.penghancuran');
//user
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::patch('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
//admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::patch('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::get('/admin/show/{id}', [AdminController::class, 'show'])->name('admin.show');
Route::get('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
//logout
Route::post('/logout', [LoginController::class, 'logout']);
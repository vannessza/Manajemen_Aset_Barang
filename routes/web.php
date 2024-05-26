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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\CheckRole;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function(){
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']); // Memastikan menggunakan metode POST
});

Route::get('/home', function(){
    return redirect('/dashboard');
});
Route::middleware(['auth', CheckRole::class. ':admin,adminsuper,user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    //aset
    Route::get('/aset', [AsetController::class, 'index'])->name('aset.index');
    Route::get('/aset/show/{id}', [AsetController::class, 'show'])->name('aset.show');
    Route::get('/aset/kategori/{id}', [AsetController::class, 'kategori'])->name('kategori.index');
    Route::get('/aset/show/pinjam/{id}', [PeminjamanController::class, 'createpinjamuser'])->name('aset.pinjam');
    Route::post('/aset/show/store/{id}', [PeminjamanController::class, 'storepinjamuser'])->name('aset.store');
    //peminjaman
    Route::get('/peminjaman/user', [PeminjamanController::class, 'indexuser'])->name('peminjaman.index.user');
    Route::get('/peminjaman/user/data peminjaman', [PeminjamanController::class, 'datapeminjaman'])->name('peminjaman.datapeminjaman.user');
    Route::get('/peminjaman/user/history', [PeminjamanController::class, 'historyuser'])->name('peminjaman.history.user');
    Route::get('/peminjaman/user/show/peminjaman/{id}', [PeminjamanController::class, 'showpeminjamanuser'])->name('peminjaman.show.user');
    Route::get('/peminjaman/user/show/history/{id}', [PeminjamanController::class, 'showhistoryuser'])->name('peminjamanhistory.show.user');
    //pengembalian
    Route::get('/pengembalian/user', [PengembalianController::class, 'indexuser'])->name('pengembalian.index.user');
    Route::get('/pengembalian/user/data pengembalian', [PengembalianController::class, 'datapengembalian'])->name('pengembalian.datapengembalian.user');
    Route::get('/pengembalian/user/create', [PengembalianController::class, 'createuser'])->name('pengembalian.create.user');
    Route::post('/pengembalian/user/store', [PengembalianController::class, 'storeuser'])->name('pengembalian.store.user');
    Route::get('/pengembalian/user/history', [PengembalianController::class, 'historyuser'])->name('pengembalian.history.user');
    Route::get('/pengembalian/user/edit/{id}', [PengembalianController::class, 'edituser'])->name('pengembalian.edit.user');
    Route::patch('/pengembalian/user/{id}', [PengembalianController::class, 'updateuser'])->name('pengembalian.update.user');
    Route::get('/pengembalian/user/delete/{id}', [PengembalianController::class, 'deleteuser'])->name('pengembalian.delete.user');
    Route::get('/pengembalian/user/show/pengembalian/{id}', [PengembalianController::class, 'showpengembalianuser'])->name('pengembalian.show.user');
    Route::get('/pengembalian/user/show/history/{id}', [PengembalianController::class, 'showhistoryuser'])->name('pengembalianhistory.show.user');
    //profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/edit/password', [ProfileController::class, 'editpassword'])->name('profile.editpassword');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/edit/ubah password', [ProfileController::class, 'storepassword'])->name('profile.editpassword.store');
    Route::get('/profile/daftar aset', [ProfileController::class, 'daftaraset'])->name('profile.daftaraset');
    Route::get('/profile/daftar aset/show/{id}', [ProfileController::class, 'daftarasetshow'])->name('profile.daftaraset.show');
    Route::get('/profile/daftar aset/pengembalian/{id}', [ProfileController::class, 'pengembalian'])->name('profile.daftaraset.pengembalian');
    Route::get('/profile/history', [ProfileController::class, 'history'])->name('profile.history');
});

Route::middleware(['auth', CheckRole::class. ':admin,adminsuper'])->group(function () {
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
    Route::get('/data aset/detail aset/{aset}/{asetDetail}/show', [AsetDetailController::class, 'show'])->name('detailaset.show');
    Route::get('/data aset/detail aset/{aset}/{asetDetail}/edit', [AsetDetailController::class, 'edit'])->name('detailaset.edit');
    Route::patch('/data aset/detail aset/{aset}/{asetDetail}/update', [AsetDetailController::class, 'update'])->name('detailaset.update');
    Route::get('/data aset/detail aset/{aset}/{asetDetail}/delete', [AsetDetailController::class, 'delete'])->name('detailaset.delete');
    //peminjaman Admin dan super admin
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/data peminjaman', [PeminjamanController::class, 'peminjaman'])->name('peminjaman.datapeminjaman');
    Route::get('/peminjaman/history', [PeminjamanController::class, 'history'])->name('peminjaman.history');
    Route::get('/peminjaman/show/peminjaman/{id}', [PeminjamanController::class, 'showpeminjaman'])->name('peminjaman.show');
    Route::get('/peminjaman/show/history/{id}', [PeminjamanController::class, 'showhistory'])->name('peminjamanhistory.show');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/show/{id}', [PeminjamanController::class, 'show'])->name('Peminjaman.show');
    Route::get('/peminjaman/show/export-bukti-formulir/{id}', [PeminjamanController::class, 'exportformulirbukti'])->name('peminjaman.export.bukti');
    Route::get('/peminjaman/show/word export/{id}', [PeminjamanController::class, 'exportformulir'])->name('peminjaman.show.exportformulir');
    Route::get('/peminjaman/edit/{id}', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::patch('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
    Route::get('/peminjaman/delete/{id}', [PeminjamanController::class, 'delete'])->name('peminjaman.delete');
    //pengembalian Admin dan super admin
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('/pengembalian/data pengembalian', [PengembalianController::class, 'pengembalian'])->name('pengembalian.datapengembalian');
    Route::get('/pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
    Route::get('/pengembalian/history', [PengembalianController::class, 'history'])->name('pengembalian.history');
    Route::get('/pengembalian/show/history/{id}', [PengembalianController::class, 'showhistory'])->name('pengembalianhistory.show');
    Route::post('/pengembalian/store', [PengembalianController::class, 'store'])->name('pengembalian.store');
    Route::get('/pengembalian/show/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show');
    Route::get('/pengembalian/show/export-bukti-formulir/{id}', [PengembalianController::class, 'exportformulirbukti'])->name('pengembalian.export.bukti');
    Route::get('/pengembalian/show/word export/{id}', [PengembalianController::class, 'exportformulir'])->name('pengembalian.show.exportformulir');
    // Route::get('/pengembalian/user/show/{id}', [PengembalianController::class, 'showuser'])->name('pengembalian.show.user');
    Route::get('/pengembalian/edit/{id}', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
    Route::patch('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
    Route::get('/pengembalian/delete/{id}', [PengembalianController::class, 'delete'])->name('pengembalian.delete');
    //user
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/show/daftar aset/{id}', [UserController::class, 'daftaraset'])->name('user.show.daftaraset');
    Route::get('/user/show/history/{id}', [UserController::class, 'history'])->name('user.show.history');
    Route::get('/user/show/daftar aset/tambah aset/{id}', [UserController::class, 'tambahaset'])->name('user.show.tambahaset.create');
    Route::post('/user/show/daftar aset/tambah aset/store/{id}', [UserController::class, 'tambahasetstore'])->name('user.show.tambahaset.store');
    Route::get('/user/show/daftar aset/show/{user_id}/{peminjaman_id}', [UserController::class, 'daftarasetshow'])->name('user.show.daftaraset.show');
    Route::get('/user/show/daftar aset/show history/{user_id}/{peminjaman_id}', [UserController::class, 'hsitoryshow'])->name('user.show.daftaraset.showhistory');
    Route::get('/user/show/daftar aset/show/word export/{user_id}/{peminjaman_id}', [UserController::class, 'exportformulir'])->name('user.show.daftaraset.exportformulir');
    Route::get('/user/show/daftar aset/show/upload/{user_id}/{peminjaman_id}', [UserController::class, 'uploadformulir'])->name('user.show.daftaraset.uploadformulir');
    Route::get('/user/show/daftar-aset/show/export-bukti-formulir/{user_id}/{peminjaman_id}', [UserController::class, 'exportformulirbukti'])->name('user.show.daftaraset.exportbuktiformulir');
    Route::patch('/user/show/daftar aset/show/upload/update/{user_id}/{peminjaman_id}', [UserController::class, 'uploadformulirupdate'])->name('user.show.daftaraset.uploadformulir.update');
    Route::get('/user/show/daftar aset/pengembalian/{user_id}/{peminjaman_id}', [UserController::class, 'pengembalian'])->name('user.show.daftaraset.pengembalian');
    Route::get('/user/show/daftar aset/show/pengembalian/word export/{user_id}/{peminjaman_id}', [UserController::class, 'exportformulirpengembalian'])->name('user.show.daftaraset.pengembalian.exportformulir');
    Route::post('/user/show/daftar aset/show/pengembalian/store/{user_id}/{peminjaman_id}', [UserController::class, 'pengembalianstore'])->name('user.show.daftaraset.pengembalian.store');
    Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('/user/edit/password/{id}', [UserController::class, 'editpassword'])->name('user.password.edit');
    Route::post('/user/edit/ubah password', [UserController::class, 'storepassword'])->name('user.password.store');
    //Penghancuran Admin dan Super admin
    Route::get('/penghancuran', [PenghancuranController::class, 'index'])->name('penghancuran.index');
    Route::get('/penghancuran/data penghancuran', [PenghancuranController::class, 'penghancuran'])->name('penghancuran.datapenghancuran');
    Route::get('/penghancuran/history', [PenghancuranController::class, 'history'])->name('penghancuran.history');
    Route::get('/penghancuran/create', [PenghancuranController::class, 'create'])->name('penghancuran.create');
    Route::post('/penghancuran/store', [PenghancuranController::class, 'store'])->name('penghancuran.store');
    Route::get('/penghancuran/delete/{id}', [PenghancuranController::class, 'delete'])->name('penghancuran.delete');
    Route::get('/penghancuran/show/{id}', [PenghancuranController::class, 'show'])->name('penghancuran.show');
    Route::get('/penghancuran/edit/{id}', [PenghancuranController::class, 'edit'])->name('penghancuran.edit');
    Route::patch('/penghancuran/{id}', [PenghancuranController::class, 'update'])->name('penghancuran.update');
    //Request
    Route::get('/request', [RequestController::class, 'index'])->name('request.index');
    Route::get('/request/terima peminjaman/{id}', [RequestController::class, 'terimapeminjaman'])->name('request.terima.peminjaman');
    Route::patch('/request/terima-peminjaman/update/{id}', [RequestController::class, 'terimapeminjamanupdate'])->name('request.update.terima.peminjaman');
    Route::get('/request/tolak peminjaman/{id}', [RequestController::class, 'tolakpeminjaman'])->name('request.tolak.peminjaman');
    Route::patch('/request/tolak peminjaman/update/{id}', [RequestController::class, 'tolakpeminjamanupdate'])->name('request.update.tolak.peminjaman');
    Route::get('/request/peminjaman/show/{id}', [RequestController::class, 'showpeminjaman'])->name('request.show.peminjaman');
    Route::get('/request/terima pengembalian/{id}', [RequestController::class, 'terimapengembalian'])->name('request.terima.pengembalian');
    Route::patch('/request/terima pengembalian/update/{id}', [RequestController::class, 'terimapengembaliannupdate'])->name('request.update.terima.pengembalian');
    Route::get('/request/tolak pengembalian/{id}', [RequestController::class, 'tolakpengembalian'])->name('request.tolak.pengembalian');
    Route::patch('/request/tolak pengembalian/update/{id}', [RequestController::class, 'tolakpengembalianupdate'])->name('request.update.tolak.pengembalian');
    Route::get('/request/pengembalian/show/{id}', [RequestController::class, 'showpengembalian'])->name('request.show.pengembalian');
    //setting
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::get('/setting/divisi', [SettingController::class, 'indexdivisi'])->name('setting.index.divisi');
    Route::get('/setting/divisi/create', [SettingController::class, 'createdivisi'])->name('setting.create.divisi');
    Route::post('/setting/divisi/store', [SettingController::class, 'storedivisi'])->name('setting.store.divisi');
    Route::get('/setting/divisi/edit/{id}', [SettingController::class, 'editdivisi'])->name('setting.edit.divisi');
    Route::patch('/setting/divisi/update/{id}', [SettingController::class, 'updatedivisi'])->name('setting.update.divisi');
    Route::get('/setting/divisi/delete/{id}', [SettingController::class, 'deletedivisi'])->name('setting.delete.divisi');
    Route::get('/setting/lokasi', [SettingController::class, 'indexlokasi'])->name('setting.index.lokasi');
    Route::get('/setting/lokasi/create', [SettingController::class, 'createlokasi'])->name('setting.create.lokasi');
    Route::post('/setting/lokasi/store', [SettingController::class, 'storelokasi'])->name('setting.store.lokasi');
    Route::get('/setting/lokasi/edit/{id}', [SettingController::class, 'editlokasi'])->name('setting.edit.lokasi');
    Route::patch('/setting/lokasi/update/{id}', [SettingController::class, 'updatelokasi'])->name('setting.update.lokasi');
    Route::get('/setting/lokasi/delete/{id}', [SettingController::class, 'deletelokasi'])->name('setting.delete.lokasi');
    Route::get('/setting/notification', [SettingController::class, 'indexnotification'])->name('setting.index.notification');
    Route::get('/setting/notification/create', [SettingController::class, 'createnotification'])->name('setting.create.notification');
    Route::post('/setting/notificaation/store', [SettingController::class, 'storenotification'])->name('setting.store.notification');
    Route::get('/setting/notification/delete/{id}', [SettingController::class, 'deletenotification'])->name('setting.delete.notification');
});

Route::middleware(['auth', CheckRole::class. ':adminsuper'])->group(function () {
    //request
    Route::get('/request/terima penghancuran/{id}', [RequestController::class, 'terimapenghancuran'])->name('request.terima.penghancuran');
    Route::patch('/request/terima penghancuran/update/{id}', [RequestController::class, 'terimapenghancuranupdate'])->name('request.update.terima.penghancuran');
    Route::get('/request/tolak penghancuran/{id}', [RequestController::class, 'tolakpenghancuran'])->name('request.tolak.penghancuran');
    Route::patch('/request/tolak penghancuran/update/{id}', [RequestController::class, 'tolakpenghancuranupdate'])->name('request.update.tolak.penghancuran');
    Route::get('/request/penghancuran/show/{id}', [RequestController::class, 'showpenghancuran'])->name('request.show.penghancuran');
    //admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::patch('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/admin/show/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/show/daftar aset/{id}', [AdminController::class, 'daftaraset'])->name('admin.show.daftaraset');
    Route::get('/admin/show/history/{id}', [AdminController::class, 'history'])->name('admin.show.history');
    Route::get('/admin/show/daftar aset/tambah aset/{id}', [AdminController::class, 'tambahaset'])->name('admin.show.tambahaset.create');
    Route::post('/admin/show/daftar aset/tambah aset/store/{id}', [AdminController::class, 'tambahasetstore'])->name('admin.show.tambahaset.store');
    Route::get('/admin/show/daftar aset/show/{user_id}/{peminjaman_id}', [AdminController::class, 'daftarasetshow'])->name('admin.show.daftaraset.show');
    Route::get('/admin/show/daftar aset/show history/{user_id}/{peminjaman_id}', [AdminController::class, 'hsitoryshow'])->name('admin.show.daftaraset.showhistory');
    Route::get('/admin/show/daftar aset/show/word export/{user_id}/{peminjaman_id}', [AdminController::class, 'exportformulir'])->name('admin.show.daftaraset.exportformulir');
    Route::get('/admin/show/daftar aset/show/upload/{user_id}/{peminjaman_id}', [AdminController::class, 'uploadformulir'])->name('admin.show.daftaraset.uploadformulir');
    Route::get('/admin/show/daftar-aset/show/export-bukti-formulir/{user_id}/{peminjaman_id}', [AdminController::class, 'exportformulirbukti'])->name('admin.show.daftaraset.exportbuktiformulir');
    Route::patch('/admin/show/daftar aset/show/upload/update/{user_id}/{peminjaman_id}', [AdminController::class, 'uploadformulirupdate'])->name('admin.show.daftaraset.uploadformulir.update');
    Route::get('/admin/show/daftar aset/pengembalian/{user_id}/{peminjaman_id}', [AdminController::class, 'pengembalian'])->name('admin.show.daftaraset.pengembalian');
    Route::get('/admin/show/daftar aset/show/pengembalian/word export/{user_id}/{peminjaman_id}', [AdminController::class, 'exportformulirpengembalian'])->name('admin.show.daftaraset.pengembalian.exportformulir');
    Route::post('/admin/show/daftar aset/show/pengembalian/store/{user_id}/{peminjaman_id}', [AdminController::class, 'pengembalianstore'])->name('admin.show.daftaraset.pengembalian.store');
    Route::get('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('/admin/edit/password/{id}', [AdminController::class, 'editpassword'])->name('admin.password.edit');
    Route::post('/admin/edit/ubah password', [AdminController::class, 'storepassword'])->name('admin.password.store');
});




//logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
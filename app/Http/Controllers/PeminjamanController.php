<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Jobs\SendEmailRequest;
use App\Jobs\SendEmailRequestRespon;
use App\Models\History;
use App\Models\Lokasi;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Aset;
use App\Models\AsetDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna = Auth::user();
        $peminjaman = Peminjaman::all();
        $peminjamanDiterima = $peminjaman->filter(function ($peminjaman) {
            return $peminjaman->status === 'Diterima';
        });
        return view('dashboard.transaksi.peminjaman.index', [
            'peminjaman' => $peminjamanDiterima,
            'title' => 'Peminjaman',
            'pengguna' => $pengguna
        ]);
    }
    public function indexUser(){
        $user = Auth::user();
        $peminjaman = $user->peminjaman;
    
        return view('dashboard.transaksi.peminjamanuser.index', compact('user'), [
            'title' => 'Peminjaman',
            'pengguna' => $user
        ]);
    }
    
    public function peminjaman(){
        $pengguna = Auth::user();
        $peminjaman = Peminjaman::all();
        $peminjamanDiterima = $peminjaman->filter(function ($peminjaman) {
            return $peminjaman->status === 'Diterima';
        });
        return view('dashboard.transaksi.peminjaman.peminjaman', [
            'peminjaman' => $peminjamanDiterima,
            'title' => 'Peminjaman',
            'pengguna' => $pengguna
        ]);
    }

    public function datapeminjaman(){
        $user = Auth::user();
        $peminjaman = $user->peminjaman->filter(function ($peminjaman){
            return $peminjaman->status === "Diterima";
        });
    
        return view('dashboard.transaksi.peminjamanuser.peminjaman', compact('peminjaman', 'user'), [
            'title' => 'Peminjaman',
            'pengguna' => $user
        ]);
    }

    public function history(){
        $user = Auth::user();
        $peminjaman = Peminjaman::latest()->get();
    
        return view('dashboard.transaksi.peminjaman.history', compact('peminjaman', 'user'), [
            'title' => 'Peminjaman',
            'pengguna' => $user
        ]);
    }

    public function historyuser(){
        $user = Auth::user();
        $peminjaman = $user->peminjaman()->latest()->get();
    
        return view('dashboard.transaksi.peminjamanuser.history', compact('peminjaman', 'user'), [
            'title' => 'Peminjaman',
            'pengguna' => $user
        ]);
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengguna = Auth::user();
        $user = User::all();
        $lokasi = Lokasi::all();
        $aset = Aset::with('AsetDetail')->get();

        return view('dashboard.transaksi.peminjaman.peminjamancreate', compact('user', 'aset', 'lokasi'),[
            'title' => 'Create Peminjaman',
            'pengguna' => $pengguna
        ]);
    }
    public function createpinjamuser($id){
        $pengguna = Auth::user();
        $asetDetail = AsetDetail::findOrFail($id);
        $lokasi = Lokasi::all();
        return view('dashboard.kelolaaset.aset.pinjamcreate', compact('asetDetail', 'lokasi'), [
            'title' => 'Aset Detail',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mendapatkan peminjaman terakhir
        $lastPeminjaman = Peminjaman::latest()->first();

        // Mengambil ID peminjaman terakhir
        $lastPeminjamanId = $lastPeminjaman ? $lastPeminjaman->id : 0;

        // Membuat nomor urut peminjaman baru dengan format 4 digit menggunakan ID
        $nomerUrutPeminjaman = str_pad($lastPeminjamanId + 1, 4, '0', STR_PAD_LEFT);

        // Mendapatkan aset, user, dan lokasi berdasarkan ID yang diberikan dalam request
        $aset = Aset::findOrFail($request->aset);
        $user = User::findOrFail($request->namaPeminjam);
        $divisi = $user->profile->divisi->kodeDivisi;
        $lokasi = Lokasi::findOrFail($request->lokasi);

        // Menggabungkan semua informasi untuk membuat kode peminjaman baru
        $kodePeminjaman = $nomerUrutPeminjaman . '/' . $aset->kodeAset . '/' . $divisi . '/' . $lokasi->kodeLokasi;

        // Menentukan status berdasarkan keberadaan gambar dalam request
        $status = $request->hasFile('image') ? "Diterima" : "Diproses";

        // Validasi input
        $request->validate([
            'keterangan' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048', // Max 2MB
        ]);

        // Jika ada file gambar di-upload, simpan gambar tersebut
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('peminjaman-images');
        } else {
            $imagePath = null;
        }

        // Simpan data peminjaman baru
        $dataPeminjaman = Peminjaman::create([
            'user_id' => $request->namaPeminjam,
            'aset_id' => $request->aset,
            'nama_aset_id' => $request->namaAset,
            'kodePeminjaman' => $kodePeminjaman,
            'tglPeminjaman' => $request->tglPeminjaman,
            'status' => $status,
            'lokasi_id' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'image' => $imagePath
        ]);

        // Membuat log kegiatan (history) setelah peminjaman diterima
        if ($status === 'Diterima') {
            $history = History::create([
                'user_id' => $request->namaPeminjam,
                'user_detail_id' => $request->namaAset,
                'action' => 'Peminjaman',
                'keterangan' => 'Peminjaman ' . $aset->namaAset . ' diterima pada ' . now()->toDateTimeString()
            ]);

            $data['email'] = $dataPeminjaman->user->email;
            $data['respon'] = "Diterima";
            $data['request'] = "Peminjaman";
            $data['name'] = $dataPeminjaman->user->name;
            $data['namaAset'] = $dataPeminjaman->AsetDetail->namaAset;
            $data['kategori'] = $dataPeminjaman->aset->namaAset;
            $data['tanggal'] = $dataPeminjaman->tglPeminjaman;
            $data['lokasi'] = $dataPeminjaman->lokasi->alamat;
            $data['keterangan'] = $dataPeminjaman->keterangan;
        
            dispatch(new SendEmailRequestRespon($data));
        }

        // Mengecek jumlah peminjaman dengan nama_aset_id yang sama
        $jumlahPeminjaman = Peminjaman::where('nama_aset_id', $request->namaAset)
                            ->where('status', 'Diterima')
                            ->count();
        // Mendapatkan jumlah aset pada AsetDetail dengan id yang sama
        $asetDetail = AsetDetail::findOrFail($request->namaAset);

        // Mengubah status aset detail menjadi tidak tersedia jika jumlah peminjaman sama dengan jumlah aset pada AsetDetail
        if ($jumlahPeminjaman == $asetDetail->jumlah) {
            $asetDetail->update([
                'status' => 'Tidak Tersedia'
            ]);
        } else {
            $asetDetail->update([
                'status' => 'Tersedia'
            ]);
        }

        // Redirect ke halaman indeks peminjaman
        return redirect(route('peminjaman.datapeminjaman'));
    }




    public function storepinjamuser($id, Request $request){
        $asetDetail = AsetDetail::findOrFail($id);
        $user = Auth::user();
        $admin = User::all();

        $adminUsers = User::where('role', 'admin')->orWhere('role', 'adminsuper')->get();

        $dataPeminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'aset_id' => $asetDetail->aset->id,
            'nama_aset_id' => $asetDetail->id,
            'tglPeminjaman' => $request->tglPeminjaman,
            'status' => "Diproses",
            'lokasi_id' => $request->lokasi,
            'keterangan' => "Sedang diproses",
        ]);

        $dataPeminjaman->save();

        foreach ($adminUsers as $admin) {
            $data['email'] = $admin->email;
            $data['request'] = "Peminjaman";
            $data['name'] = $dataPeminjaman->user->name;
            $data['namaAset'] = $dataPeminjaman->AsetDetail->namaAset;
            $data['kategori'] = $dataPeminjaman->aset->namaAset;
            $data['tanggal'] = $dataPeminjaman->tglPeminjaman;
            $data['lokasi'] = $dataPeminjaman->lokasi->alamat;
        
            dispatch(new SendEmailRequest($data));
        }        

        return redirect(route('peminjaman.history.user'));
    }

    /**
     * Display the specified resource.
     */
    public function exportformulir($id){
        $userPemberi = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);

        // Set lokalitas Carbon ke bahasa Indonesia
        App::setLocale('id');

        $hari = Carbon::parse($peminjaman->tglPeminjaman)->translatedFormat('l');

        $tglPeminjaman = Carbon::parse($peminjaman->tglPeminjaman)->translatedFormat('j F Y');

        $templatePeminjaman = new TemplateProcessor('word-template/peminjaman.docx');
        $templatePeminjaman->setValue('id', $peminjaman->id);
        $templatePeminjaman->setValue('tanggal', $tglPeminjaman);
        $templatePeminjaman->setValue('hari', $hari);
        $templatePeminjaman->setValue('jenisAset', $peminjaman->aset->namaAset);
        $templatePeminjaman->setValue('merek', $peminjaman->asetDetail->namaAset);
        $templatePeminjaman->setValue('kodeAset', $peminjaman->aset->kodeAset);
        $templatePeminjaman->setValue('namaPemberi', $userPemberi->name);
        $templatePeminjaman->setValue('divisiPemberi', $userPemberi->profile->divisi->namaDivisi);
        $templatePeminjaman->setValue('namaPenerima', $peminjaman->user->name);
        $templatePeminjaman->setValue('divisiPenerima', $peminjaman->user->profile->divisi->namaDivisi);
        $fileName = $peminjaman->user->name;
        $templatePeminjaman->saveAs('peminjaman'.$fileName.'.docx');
        
        return response()->download('peminjaman'.$fileName.'.docx')->deleteFileAfterSend(true);
    }
    public function exportformulirbukti($id){
        $peminjaman = Peminjaman::findOrFail($id);

        // Pastikan gambar tersedia
        if (!Storage::disk('public')->exists($peminjaman->image)) {
            abort(404);
        }

        // Path lengkap file gambar
        $path = storage_path('app/public/' . $peminjaman->image);

        // Mendapatkan nama file gambar
        $filename = pathinfo($path, PATHINFO_FILENAME);

        // Mendapatkan ekstensi file gambar
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        // Buat nama file yang unik dengan ekstensi yang benar
        $downloadFileName = $filename . '.' . $extension;

        // Unduh file gambar
        return response()->file($path, ['Content-Disposition' => 'attachment; filename="' . $downloadFileName . '"']);
    }
    public function showpeminjamanuser($id){
        $pengguna = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);
        return view('dashboard.transaksi.peminjamanUser.showpeminjaman', compact('peminjaman'), [
            'title' => 'Detail Peminjaman',
            'pengguna' => $pengguna
        ]);
    }

    public function showpeminjaman($id)
    {
        $pengguna = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);

        return view('dashboard.transaksi.peminjaman.showpeminjaman', compact('peminjaman'), [
            'title' => 'Detail Peminjaman',
            'pengguna' => $pengguna
        ]);
    }

    public function showhistory($id){
        $pengguna = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);
        return view('dashboard.transaksi.peminjaman.showhistorypeminjaman', compact('peminjaman'), [
            'title' => 'Detail Peminjaman',
            'pengguna' => $pengguna
        ]);
    }    
    public function showhistoryuser($id){
        $pengguna = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);
        return view('dashboard.transaksi.peminjamanUser.showhistorypeminjaman', compact('peminjaman'), [
            'title' => 'Detail Peminjaman',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengguna = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);
        $user = User::all();
        $lokasi = Lokasi::all();
        $aset = Aset::with('AsetDetail')->get();
        return view('dashboard.transaksi.peminjaman.peminjamanedit', compact('peminjaman', 'user', 'lokasi', 'aset'),[
            'title' => 'Edit Peminjaman',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $oldAsetId = $peminjaman->nama_aset_id;

        $imagePath = $peminjaman->image;

        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::delete($imagePath); // Hapus gambar lama jika ada
            }
            $imagePath = $request->file('image')->store('peminjaman-images'); // Simpan gambar baru
        }

        $lastAset = Peminjaman::latest()->first();
        if ($lastAset) {
            $lastNumber = intval(substr($lastAset->kodeAset, 2)); // Ambil nomor dari kode terakhir
            $nomerUrut = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT); // Buat kode baru dengan nomor yang lebih besar
        } else {
            // Jika belum ada aset sebelumnya, mulai dengan nomor 0001
            $nomerUrut = '0001';
        }
        
        $aset = Aset::findOrFail($request->aset);
        $user = User::findOrFail($request->namaPeminjam);
        $divisi = $user->profile->divisi->kodeDivisi;
        $lokasi = Lokasi::findOrFail($request->lokasi);

        $kodePeminjaman = $nomerUrut . '/' . $aset->kodeAset . '/' . $divisi . '/' . $lokasi->kodeLokasi;

        $status = $request->image ? "Diterima" : "Diproses";

        // Mendapatkan jumlah peminjaman dengan nama_aset_id yang sama yang memiliki status 'Diterima'
        $jumlahPeminjamanDiterima = Peminjaman::where('nama_aset_id', $peminjaman->nama_aset_id)
                    ->where('status', 'Diterima')
                    ->count();

        // Mendapatkan jumlah aset pada AsetDetail dengan id yang sama
        $asetDetail = AsetDetail::findOrFail($peminjaman->nama_aset_id);

        // Mengubah status aset detail menjadi tidak tersedia jika jumlah peminjaman yang diterima sama dengan jumlah aset pada AsetDetail
        if ($jumlahPeminjamanDiterima == $asetDetail->jumlah) {
            $asetDetail->update([
                'status' => 'Tidak Tersedia'
            ]);
        } else {
            $asetDetail->update([
                'status' => 'Tersedia'
            ]);
        }

        $peminjaman->update([
            'user_id' => $request->namaPeminjam,
            'aset_id' => $request->aset,
            'nama_aset_id' => $request->namaAset,
            'kodePeminjaman' => $kodePeminjaman,
            'tglPeminjaman' => $request->tglPeminjaman,
            'status' => $status,
            'lokasi_id' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'image' => $imagePath
        ]);

        // hapus history lama
        History::where('user_id', $peminjaman->user_id)
            ->where('user_detail_id', $peminjaman->nama_aset_id)
            ->delete();

            if ($status === 'Diterima') {
                $history = History::create([
                    'user_id' => $request->namaPeminjam,
                    'user_detail_id' => $request->namaAset,
                    'action' => 'Peminjaman',
                    'keterangan' => 'Peminjaman ' . $aset->namaAset . ' diterima pada ' . now()->toDateTimeString()
                ]);
    
                $data['email'] = $peminjaman->user->email;
                $data['respon'] = "Diterima";
                $data['request'] = "Peminjaman";
                $data['name'] = $peminjaman->user->name;
                $data['namaAset'] = $peminjaman->AsetDetail->namaAset;
                $data['kategori'] = $peminjaman->aset->namaAset;
                $data['tanggal'] = $peminjaman->tglPeminjaman;
                $data['lokasi'] = $peminjaman->lokasi->alamat;
                $data['keterangan'] = $peminjaman->keterangan;
            
                dispatch(new SendEmailRequestRespon($data));
            }
            
        // buat history baru
        $history = History::create([
            'user_id' => $peminjaman->user_id,
            'user_detail_id' => $peminjaman->nama_aset_id,
            'action' => 'Peminjaman',
            'keterangan' => 'Peminjaman ' . $aset->namaAset . ' diperbarui pada ' . now()->toDateTimeString()
        ]);

        // maka kembalikan statusnya menjadi "Tersedia"
        if ($oldAsetId != $request->namaAset && Peminjaman::where('nama_aset_id', $oldAsetId)->count() == 0) {
            $oldAsetDetail = AsetDetail::findOrFail($oldAsetId);
            $oldAsetDetail->update([
                'status' => 'Tersedia'
            ]);
        }

        return redirect(route('peminjaman.index'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        if ($peminjaman->image) {
            Storage::delete($peminjaman->image);
        }

        return redirect()->route('peminjaman.history');
    }
}

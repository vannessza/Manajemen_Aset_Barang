<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailRequestPenghancuranRespon;
use App\Jobs\SendEmailRequestRespon;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Penghancuran;
use App\Models\Lokasi;
use App\Models\User;
use App\Models\Aset;
use App\Models\AsetDetail;
use App\Models\History;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna = Auth::user();
        $peminjaman = Peminjaman::all();
        $pengembalian = Pengembalian::all();
        $penghancuran = Penghancuran::all();

        // Filter data peminjaman yang memiliki status "diproses"
        $peminjamanDiproses = $peminjaman->filter(function ($peminjaman) {
            return $peminjaman->status === 'Diproses';
        });

        // Filter data pengembalian yang memiliki status "diproses"
        $pengembalianDiproses = $pengembalian->filter(function ($pengembalian) {
            return $pengembalian->status === 'Diproses';
        });

        // Filter data penghancuran yang memiliki status "diproses"
        $penghancuranDiproses = $penghancuran->filter(function ($penghancuran) {
            return $penghancuran->status === 'Diproses';
        });

        return view('dashboard.transaksi.request.index', [
            'peminjaman' => $peminjamanDiproses,
            'pengembalian' => $pengembalianDiproses,
            'penghancuran' => $penghancuranDiproses,
            'title' => 'Request',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function terimapeminjaman($id)
    {
        $pengguna = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);
        
        return view('dashboard.transaksi.request.terimapeminjaman', compact('peminjaman'),[
            'title' => 'Terima',
            'pengguna' => $pengguna
        ]);
    }

    public function terimapengembalian($id)
    {
        $pengguna = Auth::user();
        $lokasi = Lokasi::all();
        $pengembalian = Pengembalian::findOrFail($id);
        
        return view('dashboard.transaksi.request.terimapengembalian', compact('pengembalian', 'lokasi'),[
            'title' => 'Terima',
            'pengguna' => $pengguna
        ]);
    }

    public function terimapenghancuran($id)
    {
        $pengguna = Auth::user();
        $penghancuran = Penghancuran::findOrFail($id);

        return view('dashboard.transaksi.request.terimapenghancuran', compact('penghancuran'),[
            'title' => 'Terima',
            'pengguna' => $pengguna
        ]);
    }

    public function tolakpeminjaman($id)
    {
        $pengguna = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);

        return view('dashboard.transaksi.request.tolakpeminjaman', compact('peminjaman'), [
            'title' => 'Tolak',
            'pengguna' => $pengguna
        ]);
    }
    public function tolakpengembalian($id)
    {
        $pengguna = Auth::user();
        $pengembalian = Pengembalian::findOrFail($id);

        return view('dashboard.transaksi.request.tolakpengembalian', compact('pengembalian'), [
            'title' => 'Tolak',
            'penggunaa' => $pengguna
        ]);
    }
    public function tolakpenghancuran($id)
    {
        $pengguna = Auth::user();
        $penghancuran = Penghancuran::findOrFail($id);

        return view('dashboard.transaksi.request.tolakpenghancuran', compact('penghancuran'), [
            'title' => 'Tolak',
            'pengguna' => $pengguna
        ]);
    }
    public function terimapeminjamanupdate(Request $request, $id)
    {   

        $request->validate([
            'keterangan' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
        ], [
            'keterangan.required' => 'Kolom keterangan wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format file harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ]);

        // Mencari peminjaman berdasarkan ID
        
        $peminjaman = Peminjaman::findOrFail($id);
        
        
        // Cek status aset detail
        $asetDetail = AsetDetail::findOrFail($peminjaman->nama_aset_id);
        if ($asetDetail->status == 'Tidak Tersedia') {
            return back()->withErrors(['namaAset' => 'Aset yang dipilih tidak tersedia.']);
        }

        // Inisialisasi variabel $kodePeminjaman dan $imagePath
        $kodePeminjaman = $peminjaman->kodePeminjaman;
        $imagePath = $peminjaman->image;

        // Menentukan status berdasarkan apakah ada gambar atau tidak
        $status = $request->hasFile('image') ? "Diterima" : "Diproses";

        // Jika ada file gambar di-upload, simpan gambar tersebut dan perbarui kode peminjaman
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($peminjaman->image) {
                Storage::delete($peminjaman->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('peminjaman-images');

            // Membuat kode peminjaman dengan format yang diminta
            $nomerUrutBarang = str_pad($peminjaman->id, 4, '0', STR_PAD_LEFT);
            $aset = Aset::findOrFail($peminjaman->aset_id);
            $divisi = User::findOrFail($peminjaman->user_id)->profile->divisi->kodeDivisi;
            $lokasi = Lokasi::findOrFail($peminjaman->lokasi_id);
            $kodePeminjaman = $nomerUrutBarang . '/' . $aset->kodeAset . '/' . $divisi . '/' . $lokasi->kodeLokasi;
        }

        // Memperbarui data peminjaman
        $peminjaman->update([
            'keterangan' => $request->keterangan,
            'image' => $imagePath,
            'status' => $status,
            'kodePeminjaman' => $kodePeminjaman,
        ]);

        // Membuat log kegiatan (history) setelah peminjaman diterima
        if ($status === 'Diterima') {
            $history = History::create([
                'user_id' => $peminjaman->user_id,
                'aset_detail_id' => $peminjaman->nama_aset_id,
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
                // Mengecek jumlah peminjaman dengan nama_aset_id yang sama
            $jumlahPeminjaman = Peminjaman::where('nama_aset_id', $peminjaman->nama_aset_id)
            ->where('status', 'Diterima')
            ->count();
            // Mendapatkan jumlah aset pada AsetDetail dengan id yang sama
            $asetDetail = AsetDetail::findOrFail($peminjaman->nama_aset_id);

            // Mengubah status aset detail menjadi tidak tersedia jika jumlah peminjaman sama dengan jumlah aset pada AsetDetail
            if ($jumlahPeminjaman >= $asetDetail->jumlah) {
            $asetDetail->update([
            'status' => 'Tidak Tersedia'
            ]);
            } else {
            $asetDetail->update([
            'status' => 'Tersedia'
            ]);
            }
        }
        return redirect(route('request.index'));
    }




    public function terimapengembaliannupdate(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'keterangan' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
        ], [
            'keterangan.required' => 'Kolom keterangan wajib diisi.',
            'image.mimes' => 'Format file harus jpeg, png, jpg, gif, pdf, atau docx.',
            'image.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ]);

        $pengembalian = Pengembalian::findOrFail($id);

        // Cek status dikembalikan sebelum pembaruan
        if ($pengembalian->status == 'Dikembalikan') {
            return back()->withErrors('Aset sudah Dikembalikan.');
        }

        // Menentukan status berdasarkan apakah ada gambar atau tidak
        $status = $request->hasFile('image') ? "Dikembalikan" : "Diproses";

        // Jika ada file gambar di-upload, simpan gambar tersebut
        $imagePath = $pengembalian->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pengembalian-images');

            // Hapus gambar lama jika ada
            if ($pengembalian->image) {
                Storage::delete($pengembalian->image);
            }
        }

        // Memperbarui data pengembalian
        $pengembalian->update([
            'keterangan' => $request->keterangan,
            'lokasi'=> $request->lokasi,
            'image' => $imagePath,
            'status' => $status,
        ]);

        if ($status === 'Dikembalikan') {
            $peminjaman = Peminjaman::where('kodePeminjaman', $pengembalian->kodePengembalian)->first();

            $history = History::create([
                'user_id' => $pengembalian->user_id,
                'aset_detail_id' => $pengembalian->nama_aset_id,
                'action' => 'Pengembalian',
                'keterangan' => 'Pengembalian ' . $pengembalian->aset->namaAset . ' dibuat pada ' . now()->toDateTimeString()
            ]);

            $peminjaman->update([
                'status' => 'Dikembalikan'
            ]);

            $data['email'] = $pengembalian->user->email;
            $data['respon'] = "Diterima";
            $data['request'] = "Pengembalian";
            $data['name'] = $pengembalian->user->name;
            $data['namaAset'] = $pengembalian->AsetDetail->namaAset;
            $data['kategori'] = $pengembalian->aset->namaAset;
            $data['tanggal'] = $pengembalian->tglPeminjaman;
            $data['lokasi'] = $pengembalian->lokasi->alamat;
            $data['keterangan'] = $pengembalian->keterangan;

            dispatch(new SendEmailRequestRespon($data));

            // Mengecek jumlah peminjaman dengan nama_aset_id yang sama
            $jumlahPeminjaman = Peminjaman::where('nama_aset_id', $pengembalian->nama_aset_id)
                ->where('status', 'Diterima')
                ->count();
            // Mendapatkan jumlah aset pada AsetDetail dengan id yang sama
            $asetDetail = AsetDetail::findOrFail($pengembalian->nama_aset_id);

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
        }

        return redirect(route('request.index'));
    }



    public function terimapenghancuranupdate(Request $request, $id){
        $penghancuran = Penghancuran::findOrFail($id);
        $user = Auth::user();
        // Menentukan status berdasarkan apakah ada gambar atau tidak
        $status = $request->hasFile('image') ? "Disetujui" : "Diproses";

        $request->validate([
            'keterangan' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048', // Max 2MB
        ]);
        // Jika ada file gambar di-upload, simpan gambar tersebut
        $imagePath = $penghancuran->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('penghancuran');

            // Hapus gambar lama jika ada
            if ($penghancuran->image) {
                Storage::delete($penghancuran->image);
            }
        }

        // Memperbarui data pengembalian
        $penghancuran->update([
            'pengesahan' => $user->id,
            'keterangan' => $request->keterangan,
            'image' => $imagePath,
            'status' => $status,
        ]);

        $penghancuran->save();

        if ($status === 'Disetujui') {

            $data['email'] = $penghancuran->userpemohon->email;
            $data['respon'] = "Diterima";
            $data['request'] = "Penghancuran";
            $data['aset'] = $penghancuran->aset->namaAset;
            $data['nama_aset'] = $penghancuran->nama_aset;
            $data['tipePemusnahan'] = $penghancuran->tipePemusnahan;
            $data['tglPemusnahan'] = $penghancuran->tglPemusnahan;
            $data['pemohon'] = $penghancuran->userpemohon->name;

            dispatch(new SendEmailRequestPenghancuranRespon($data));

            // Menghapus peminjaman berdasarkan  kode peminjaman
            AsetDetail::where('namaAset', $penghancuran->nama_aset)->delete();
        }

        

        // Redirect ke halaman indeks permintaan
        return redirect(route('request.index'));
    }


    public function tolakpeminjamanupdate(Request $request, $id) {
        // Mencari peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);
    
        // Memperbarui peminjaman dengan data yang diperoleh dari request
        $peminjaman->update([
            'keterangan' => $request->keterangan,
            'status' => "Ditolak"
        ]);

            $data['email'] = $peminjaman->user->email;
            $data['respon'] = "Ditolak";
            $data['request'] = "Peminjaman";
            $data['name'] = $peminjaman->user->name;
            $data['namaAset'] = $peminjaman->AsetDetail->namaAset;
            $data['kategori'] = $peminjaman->aset->namaAset;
            $data['tanggal'] = $peminjaman->tglPeminjaman;
            $data['lokasi'] = $peminjaman->lokasi->alamat;
            $data['keterangan'] = $peminjaman->keterangan;
        
            dispatch(new SendEmailRequestRespon($data));
    
        // Redirect ke halaman indeks permintaan
        return redirect(route('request.index'));
    }

    public function tolakpengembalianupdate(Request $request, $id) {
        // Mencari peminjaman berdasarkan ID
        $pengembalian = Pengembalian::findOrFail($id);
    
        // Memperbarui peminjaman dengan data yang diperoleh dari request
        $pengembalian->update([
            'keterangan' => $request->keterangan,
            'status' => "Ditolak"
        ]);
    
        // Redirect ke halaman indeks permintaan
        return redirect(route('request.index'));
    }
    public function tolakpenghancuranupdate(Request $request, $id) {
        // Mencari peminjaman berdasarkan ID
        $penghancuran = Penghancuran::findOrFail($id);
    
        // Memperbarui peminjaman dengan data yang diperoleh dari request
        $penghancuran->update([
            'keterangan' => $request->keterangan,
            'status' => "Ditolak"
        ]);

            $data['email'] = $penghancuran->userpemohon->email;
            $data['respon'] = "Ditolak";
            $data['request'] = "Penghancuran";
            $data['aset'] = $penghancuran->aset->namaAset;
            $data['nama_aset'] = $penghancuran->nama_aset;
            $data['tipePemusnahan'] = $penghancuran->tipePemusnahan;
            $data['tglPemusnahan'] = $penghancuran->tglPemusnahan;
            $data['pemohon'] = $penghancuran->userpemohon->name;

            dispatch(new SendEmailRequestPenghancuranRespon($data));
    
        // Redirect ke halaman indeks permintaan
        return redirect(route('request.index'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function showpeminjaman($id)
    {
        $pengguna = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);

        return view('dashboard.transaksi.request.showpeminjaman', compact('peminjaman'), [
            'title' => 'Detail Peminjaman',
            'pengguna' => $pengguna
        ]);
    }

    public function showpengembalian($id)
    {
        $pengguna = Auth::user();
        $pengembalian = Pengembalian::findOrFail($id);

        return view('dashboard.transaksi.request.showpengembalian', compact('pengembalian'), [
            'title' => 'Detail Peminjaman',
            'pengguna' => $pengguna
        ]);
    }

    public function showpenghancuran($id)
    {
        $pengguna = Auth::user();
        $penghancuran = Penghancuran::findOrFail($id);

        return view('dashboard.transaksi.request.showpenghancuran', compact('penghancuran'), [
            'title' => 'Detail Penghancuran',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

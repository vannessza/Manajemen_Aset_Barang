<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Penghancuran;
use App\Models\Lokasi;
use App\Models\User;
use App\Models\Aset;
use App\Models\AsetDetail;
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
            'title' => 'Request'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function terimapeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        return view('dashboard.transaksi.request.terimapeminjaman', compact('peminjaman'),[
            'title' => 'Terima'
        ]);
    }

    public function terimapengembalian($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        return view('dashboard.transaksi.request.terimapengembalian', compact('pengembalian'),[
            'title' => 'Terima'
        ]);
    }

    public function terimapenghancuran($id)
    {
        $penghancuran = Penghancuran::findOrFail($id);

        return view('dashboard.transaksi.request.terimapenghancuran', compact('penghancuran'),[
            'title' => 'Terima'
        ]);
    }

    public function tolakpeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        return view('dashboard.transaksi.request.tolakpeminjaman', compact('peminjaman'), [
            'title' => 'Tolak'
        ]);
    }
    public function tolakpengembalian($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        return view('dashboard.transaksi.request.tolakpengembalian', compact('pengembalian'), [
            'title' => 'Tolak'
        ]);
    }
    public function tolakpenghancuran($id)
    {
        $penghancuran = Penghancuran::findOrFail($id);

        return view('dashboard.transaksi.request.tolakpenghancuran', compact('penghancuran'), [
            'title' => 'Tolak'
        ]);
    }
    public function terimapeminjamanupdate(Request $request, $id)
    {   
        // Mencari peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        // Membuat nomor urut barang baru dengan format 4 digit menggunakan ID
        $nomerUrutBarang = str_pad($peminjaman->id, 4, '0', STR_PAD_LEFT);

        // Mendapatkan kode aset, kode divisi, dan kode lokasi
        $aset = Aset::findOrFail($peminjaman->aset_id);
        $divisi = User::findOrFail($peminjaman->user_id)->profile->divisi->kodeDivisi;
        $lokasi = Lokasi::findOrFail($peminjaman->lokasi_id);

        // Membuat kode peminjaman dengan format yang diminta
        $kodePeminjaman = $nomerUrutBarang . '/' . $aset->kodeAset . '/' . $divisi . '/' . $lokasi->kodeLokasi;

        // Menentukan status berdasarkan apakah ada gambar atau tidak
        $status = $request->hasFile('image') ? "Diterima" : "Diproses";

        // Validasi input
        $request->validate([
            'keterangan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Jika ada file gambar di-upload, simpan gambar tersebut
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($peminjaman->image) {
                Storage::delete($peminjaman->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('peminjaman');
        } else {
            $imagePath = $peminjaman->image;
        }

        // Memperbarui data peminjaman
        $peminjaman->update([
            'keterangan' => $request->keterangan,
            'image' => $imagePath,
            'status' => $status,
            'kodePeminjaman' => $kodePeminjaman,
        ]);

        // Redirect ke halaman indeks permintaan
        return redirect(route('request.index'));
    }

    public function terimapengembaliannupdate(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'keterangan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        $pengembalian = Pengembalian::findOrFail($id);

        // Menentukan status berdasarkan apakah ada gambar atau tidak
        $status = $request->hasFile('image') ? "Dikembalikan" : "Diproses";

        // Jika ada file gambar di-upload, simpan gambar tersebut
        $imagePath = $pengembalian->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pengembalian');

            // Hapus gambar lama jika ada
            if ($pengembalian->image) {
                Storage::delete($pengembalian->image);
            }
        }

        // Memperbarui data pengembalian
        $pengembalian->update([
            'keterangan' => $request->keterangan,
            'image' => $imagePath,
            'status' => $status,
        ]);

        // Menghapus peminjaman berdasarkan  kode peminjaman
        Peminjaman::where('kodePeminjaman', $pengembalian->kodePengembalian)->delete();

        // Redirect ke halaman indeks permintaan
        return redirect(route('request.index'));
    }

    public function terimapenghancuranupdate(Request $request, $id){
        $penghancuran = Penghancuran::findOrFail($id);
        $user = Auth::user();
        // Menentukan status berdasarkan apakah ada gambar atau tidak
        $status = $request->hasFile('image') ? "Disetujui" : "Diproses";

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
            'pengesahab' => $user,
            'keterangan' => $request->keterangan,
            'image' => $imagePath,
            'status' => $status,
        ]);

        // Menghapus peminjaman berdasarkan  kode peminjaman
        AsetDetail::where('namaAset', $penghancuran->nama_aset)->delete();

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
        $peminjaman = Peminjaman::findOrFail($id);

        return view('dashboard.transaksi.request.showpeminjaman', compact('peminjaman'), [
            'title' => 'Detail Peminjaman'
        ]);
    }

    public function showpengembalian($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        return view('dashboard.transaksi.request.showpengembalian', compact('pengembalian'), [
            'title' => 'Detail Peminjaman'
        ]);
    }

    public function showpenghancuran($id)
    {
        $penghancuran = Penghancuran::findOrFail($id);

        return view('dashboard.transaksi.request.showpenghancuran', compact('penghancuran'), [
            'title' => 'Detail Penghancuran'
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

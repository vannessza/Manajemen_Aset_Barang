<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Aset;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::all();

        return view('dashboard.transaksi.peminjaman.index', compact('peminjaman'), [
            'title' => 'Peminjaman'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        $lokasi = Lokasi::all();
        $aset = Aset::with('AsetDetail')->get();

        return view('dashboard.transaksi.peminjaman.peminjamancreate', compact('user', 'aset', 'lokasi'),[
            'title' => 'Create Peminjaman'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        $status = $request->image ? "Diterima" : "Progress";

        $dataPeminjaman = Peminjaman::create([
            'user_id' => $request->namaPeminjam,
            'aset_id' => $request->aset,
            'nama_aset_id' => $request->namaAset,
            'kodePeminjaman' => $kodePeminjaman,
            'tglPeminjaman' => $request->tglPeminjaman,
            'status' => $status,
            'lokasi_id' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'image' => $request->image
        ]);

        $dataPeminjaman->save();

        return redirect(route('peminjaman.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        return view('dashboard.transaksi.peminjaman.showpeminjaman', compact('peminjaman'), [
            'title' => 'Peminjaman'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $user = User::all();
        $lokasi = Lokasi::all();
        $aset = Aset::with('AsetDetail')->get();
        return view('dashboard.transaksi.peminjaman.peminjamanedit', compact('peminjaman', 'user', 'lokasi', 'aset'),[
            'title' => 'Edit Peminjaman'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

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

        $status = $request->image ? "Diterima" : "Progress";

        $peminjaman->update([
            'user_id' => $request->namaPeminjam,
            'aset_id' => $request->aset,
            'nama_aset_id' => $request->namaAset,
            'kodePeminjaman' => $kodePeminjaman,
            'tglPeminjaman' => $request->tglPeminjaman,
            'status' => $status,
            'lokasi_id' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'image' => $request->image
        ]);

        return redirect(route('peminjaman.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}

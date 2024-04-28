<?php

namespace App\Http\Controllers;


use App\Models\AsetDetail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aset;
use App\Models\Lokasi;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengembalian = Pengembalian::all();

        return view('dashboard.transaksi.pengembalian.index', compact('pengembalian'), [
            'title' => 'Pengembalian'
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
        $peminjaman = Peminjaman::all();
        $asetDetail = AsetDetail::all();
        return view('dashboard.transaksi.pengembalian.pengembaliancreate', compact('user', 'aset', 'lokasi', 'peminjaman', 'asetDetail'),[
            'title' => 'Create Pengembalian'
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
        $user = User::findOrFail($request->namaPengembali);
        $divisi = $user->profile->divisi->kodeDivisi;
        $lokasi = Lokasi::findOrFail($request->lokasi);

        $kodePengembalian = $nomerUrut . '/' . $aset->kodeAset . '/' . $divisi . '/' . $lokasi->kodeLokasi;

        $status = $request->image ? "Diterima" : "Progress";

        $dataPengembalian = Pengembalian::create([
            'user_id' => $request->namaPengembali,
            'aset_id' => $request->aset,
            'nama_aset_id' => $request->namaAset,
            'kodePengembalian' => $kodePengembalian,
            'tglPengembalian' => $request->tglPengembalian,
            'status' => $status,
            'lokasi_id' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'image' => $request->image
        ]);

        $dataPengembalian->save();

        return redirect(route('pengembalian.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        return view('dashboard.transaksi.pengembalian.showpengembalian', compact('pengembalian'), [
            'title' => 'Pengembalian'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $user = User::all();
        $lokasi = Lokasi::all();
        $aset = Aset::with('AsetDetail')->get();
        $peminjaman = Peminjaman::all();
        return view('dashboard.transaksi.pengembalian.pengembalianedit', compact('pengembalian', 'user', 'lokasi', 'aset', 'peminjaman'),[
            'title' => 'Edit Pengembalian'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengembalian $pengembalian)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AsetDetail;
use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AsetDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $pengguna = Auth::user();
        $aset = Aset::findOrFail($id);
        $asetDetail = $aset->AsetDetail()->latest()->first();
        return view('dashboard.kelolaaset.dataaset.detailaset.index', compact('aset', 'asetDetail'), [
            'title' => 'Aset Detail',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $pengguna = Auth::user();
        $aset = Aset::findOrFail($id);
        return view('dashboard.kelolaaset.dataaset.detailaset.detailasetcreate', compact('aset'), [
            'title' => 'Create Aset',
            'pengguna' => $pengguna
        ]);

        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id, Request $request)
    {
        $request->validate([
            'namaAset' => 'required|string|max:255|unique:aset_detail,namaAset',
            'detailAset' => 'nullable|string',
            'jenisAset' => 'required|string|max:255',
            'klasifikasiAset' => 'required|string',
            'masaRetensi' => 'required|integer',
            'jumlah' => 'required|integer',
            'tanggal' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'namaAset.required' => 'Kolom nama aset wajib diisi.',
            'namaAset.string' => 'Kolom nama aset harus berupa teks.',
            'namaAset.max' => 'Panjang nama aset tidak boleh melebihi 255 karakter.',
            'namaAset.unique' => 'Nama aset sudah digunakan.',
            'jenisAset.required' => 'Kolom jenis aset wajib diisi.',
            'jenisAset.string' => 'Kolom jenis aset harus berupa teks.',
            'jenisAset.max' => 'Panjang jenis aset tidak boleh melebihi 255 karakter.',
            'klasifikasiAset.required' => 'Kolom klasifikasi aset wajib diisi.',
            'masaRetensi.required' => 'Kolom masa retensi wajib diisi.',
            'masaRetensi.integer' => 'Kolom masa retensi harus berupa angka.',
            'jumlah.required' => 'Kolom jumlah wajib diisi.',
            'jumlah.integer' => 'Kolom jumlah harus berupa angka.',
            'tanggal.required' => 'Kolom tanggal pembelian wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format file harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('asetdetail-images');
        } else {
            $imagePath = null;
        }

        $detailAset = AsetDetail::create([
            'aset_id' => $id,
            'namaAset' => $request->namaAset,
            'detailAset' => $request->detailAset,
            'jenisAset' => $request->jenisAset,
            'klasifikasiAset' => $request->klasifikasiAset,
            'masaRetensi' => $request->masaRetensi,
            'tglPembelian' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'image' => $imagePath,
            'status' => "Tersedia"
        ]);

        $detailAset->save();

        return redirect()->route('detailaset.index', $id)->with('success', 'Aset berhasil dibuat.');
    }


    /**
     * Display the specified resource.
     */
    public function show($aset, $asetDetail)
    {
        $pengguna = Auth::user();
        $aset = Aset::findOrFail($aset);
        $asetDetail = AsetDetail::findOrFail($asetDetail);
        $history = $asetDetail->history()->latest()->get();
        
        return view('dashboard.kelolaaset.dataaset.detailaset.showdetailaset', compact('aset', 'asetDetail', 'history'), [
            'title' => 'Create Aset',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($aset, $asetDetail)
    {
        $pengguna = Auth::user();
        $aset = Aset::findOrFail($aset);
        $asetDetail = AsetDetail::findOrFail($asetDetail);
        return view('dashboard.kelolaaset.dataaset.detailaset.detailasetedit', compact('aset', 'asetDetail'), [
            'title' => 'Create Aset',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($aset, $asetDetail, Request $request)
    {
        $asetdetail = AsetDetail::findOrFail($asetDetail);

        $request->validate([
            'namaAset' => 'required|string|max:255|unique:aset_detail,namaAset,'.$asetdetail->id,
            'detailAset' => 'nullable|string',
            'jenisAset' => 'required|string|max:255',
            'klasifikasiAset' => 'required|string',
            'masaRetensi' => 'required|integer',
            'jumlah' => 'required|integer',
            'tanggal' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'namaAset.required' => 'Kolom nama aset wajib diisi.',
            'namaAset.string' => 'Kolom nama aset harus berupa teks.',
            'namaAset.max' => 'Panjang nama aset tidak boleh melebihi 255 karakter.',
            'namaAset.unique' => 'Nama aset sudah digunakan.',
            'jenisAset.required' => 'Kolom jenis aset wajib diisi.',
            'jenisAset.string' => 'Kolom jenis aset harus berupa teks.',
            'jenisAset.max' => 'Panjang jenis aset tidak boleh melebihi 255 karakter.',
            'klasifikasiAset.required' => 'Kolom klasifikasi aset wajib diisi.',
            'masaRetensi.required' => 'Kolom masa retensi wajib diisi.',
            'masaRetensi.integer' => 'Kolom masa retensi harus berupa angka.',
            'jumlah.required' => 'Kolom jumlah wajib diisi.',
            'jumlah.integer' => 'Kolom jumlah harus berupa angka.',
            'tanggal.required' => 'Kolom tanggal pembelian wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format file harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ]);

        $imagePath = $asetdetail->image;

        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::delete($imagePath); // Hapus gambar lama jika ada
            }
            $imagePath = $request->file('image')->store('asetdetail-images', 'public'); // Simpan gambar baru di public disk
        }

        $asetdetail->update([
            'aset_id' => $aset,
            'namaAset' => $request->namaAset,
            'detailAset' => $request->detailAset,
            'jenisAset' => $request->jenisAset,
            'klasifikasiAset' => $request->klasifikasiAset,
            'masaRetensi' => $request->masaRetensi,
            'tglPembelian' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'image' => $imagePath,
            'status' => "Tersedia",
        ]);

        return redirect()->route('detailaset.index', $aset);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($aset, $asetDetail)
{
    $asetdetail = AsetDetail::findOrFail($asetDetail);

    if ($asetdetail->image) {
        Storage::delete($asetdetail->image);
    }

    $asetdetail->delete();

    return redirect()->route('detailaset.index', $aset);
}
}

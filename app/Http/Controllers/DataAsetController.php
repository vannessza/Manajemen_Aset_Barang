<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna = Auth::user();
        $dataAset = Aset::all();

        return view('dashboard.kelolaaset.dataaset.index' , compact('dataAset') ,[
            'title' => 'Data Aset',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengguna = Auth::user();
        return view('dashboard.kelolaaset.dataaset.asetregistercreate',[
            'title' => 'Create Aset Register',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $latestAset = Aset::latest()->first();

        $latestAsetId = $latestAset ? $latestAset->id : 0;

        // Jika ID terbaru adalah 0 dan tidak ada aset, mulai dengan 1
        if ($latestAsetId == 0) {
            $kodeAset = '001';
        } else {
            // Membuat kode aset dengan format 3 digit menggunakan ID terbaru
            $kodeAset = str_pad($latestAsetId + 1, 3, '0', STR_PAD_LEFT);
        }

        // Simpan data aset baru
        $dataAset = Aset::create([
            'kodeAset' => $kodeAset,
            'namaAset' => $request->aset,
            'detailAset' => $request->detailAset,
            'jenisAset' => $request->jenisAset,
            'klasifikasiAset' => $request->klasifikasiAset,
            'asetValuation' => "0",
            'ciaLevel' => $request->ciaLevel,
            'nilaiRisiko' => $request->nilaiRisiko,
            'masaRetensi' => $request->masaRetensi
        ]);

        // Redirect ke halaman indeks data aset
        return redirect(route('dataaset.index'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengguna = Auth::user();
        $aset = Aset::findOrFail($id);

        return view('dashboard.kelolaaset.dataaset.asetregisteredit', compact('aset'),[
            'title' => 'Edit Data Aset',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $aset = Aset::findOrFail($id);
        $aset->update([
            'namaAset' => $request->aset,
            'detailAset' => $request->detailAset,
            'jenisAset' => $request->jenisAset,
            'klasifikasiAset' => $request->klasifikasiAset,
            'ciaLevel' => $request->ciaLevel,
            'nilaiRisiko' => $request->nilaiRisiko,
            'masaRetensi' => $request->masaRetensi
        ]);

        return redirect(route('dataaset.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $aset = Aset::findOrFail($id);

        $aset->delete();

        return redirect(route('dataaset.index'));
    }
}

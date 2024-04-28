<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;

class DataAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataAset = Aset::all();

        return view('dashboard.kelolaaset.dataaset.index' , compact('dataAset') ,[
            'title' => 'Data Aset'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kelolaaset.dataaset.asetregistercreate',[
            'title' => 'Create Aset Register'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Membuat kode aset secara otomatis
        $lastAset = Aset::latest()->first();
        if ($lastAset) {
            $lastNumber = intval(substr($lastAset->kodeAset, 2)); // Ambil nomor dari kode terakhir
            $kodeAset = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // Buat kode baru dengan nomor yang lebih besar
        } else {
            // Jika belum ada aset sebelumnya, mulai dengan nomor 0001
            $kodeAset = '001';
        }

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

        $dataAset->save();

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
        $aset = Aset::findOrFail($id);

        return view('dashboard.kelolaaset.dataaset.asetregisteredit', compact('aset'),[
            'title' => 'Edit Data Aset'
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

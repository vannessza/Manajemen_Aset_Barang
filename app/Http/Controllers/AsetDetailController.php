<?php

namespace App\Http\Controllers;

use App\Models\AsetDetail;
use App\Models\Aset;
use Illuminate\Http\Request;

class AsetDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $aset = Aset::findOrFail($id);
        $asetDetail = $aset->AsetDetail()->latest()->first();
        return view('dashboard.kelolaaset.dataaset.detailaset.index', compact('aset', 'asetDetail'), [
            'title' => 'Aset Detail'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $aset = Aset::findOrFail($id);
        return view('dashboard.kelolaaset.dataaset.detailaset.detailasetcreate', compact('aset'), [
            'title' => 'Create Aset'
        ]);

        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id, Request $request)
    {
        $detailAset = AsetDetail::create([
            'aset_id' => $id,
            'namaAset' => $request->namaAset,
            'detailAset' => $request->detailAset,
            'jenisAset' => $request->jenisAset,
            'klasifikasiAset' => $request->klasifikasiAset,
            'masaRetensi' => $request->masaRetensi,
            'tglPembelian' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'image' => $request->image,
            'status' => "Tersedia"
        ]);
        
        $detailAset->save();

        return redirect()->route('detailaset.index', $id);
    }

    /**
     * Display the specified resource.
     */
    public function show(AsetDetail $asetDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($aset, $asetDetail)
    {
        $aset = Aset::findOrFail($aset);
        $asetDetail = AsetDetail::findOrFail($asetDetail);
        return view('dashboard.kelolaaset.dataaset.detailaset.detailasetedit', compact('aset', 'asetDetail'), [
            'title' => 'Create Aset'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($aset, $asetDetail, Request $request)
    {
        $asetdetail = AsetDetail::findOrFail($asetDetail);
        $asetdetail->update([
            'aset_id' => $aset,
            'namaAset' => $request->namaAset,
            'detailAset' => $request->detailAset,
            'jenisAset' => $request->jenisAset,
            'klasifikasiAset' => $request->klasifikasiAset,
            'masaRetensi' => $request->masaRetensi,
            'tglPembelian' => $request->tanggal,
            'jumlah' => $request->jumlah, 
            'image' => $request->image,
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
    $asetdetail->delete();

    return redirect()->route('detailaset.index', $aset);
}
}

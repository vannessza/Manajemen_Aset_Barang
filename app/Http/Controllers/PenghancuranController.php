<?php

namespace App\Http\Controllers;

use App\Models\Penghancuran;
use App\Models\User;
use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghancuranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $user = Auth::user();
        $penghancuran = Penghancuran::all();

        return view('dashboard.transaksi.penghancuran.index', compact('penghancuran', 'user'), [
            'title' => 'Penghancuran'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $aset = Aset::with('AsetDetail')->get();

        return view('dashboard.transaksi.penghancuran.penghancurancreate', compact('user', 'aset'),[
            'title' => 'Create Penghancuran'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $status = $request->image ? "Disetujui" : "Diproses";

        $dataPengembalian = Penghancuran::create([
            'aset_id' => $request->aset,
            'nama_aset' => $request->namaAset,
            'tipePemusnahan' => $request->tipePemusnahan,
            'tglPemusnahan' => $request->tglPemusnahan,
            'status' => $status,
            'pemohon' => $user->id,
            'keterangan' => "Sedang diproses",
        ]);

        $dataPengembalian->save();

        return redirect(route('penghancuran.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penghancuran = Penghancuran::findOrFail($id);

        return view('dashboard.transaksi.penghancuran.showpenghancuran', compact('penghancuran'), [
            'title' => 'Detail Penghancuran'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penghancuran $penghancuran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penghancuran $penghancuran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $penghancuran = Penghancuran::findOrFail($id);

        $penghancuran->delete();

        return redirect(route('penghancuran.index'));
    }
}

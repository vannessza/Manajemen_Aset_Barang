<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsetDetail;
use App\Models\Aset;
class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aset = Aset::all();
        $asetDetail = AsetDetail::all();
        return view('dashboard.kelolaaset.aset.index', compact('aset', 'asetDetail'), [
            'title' => 'Aset Detail'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $asetDetail = AsetDetail::findOrFail($id);
        return view('dashboard.kelolaaset.aset.showaset', compact('asetDetail'), [
            'title' => 'Aset Detail'
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

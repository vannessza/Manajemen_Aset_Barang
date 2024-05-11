<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Penghancuran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna = Auth::user();
        $jumlahAdmin = User::where('role', 'admin')->count();

        $jumlahPeminjaman = Peminjaman::count();

        $jumlahPengembalian = Pengembalian::count();

        $jumlahPenghancuran = Penghancuran::count();

        $jumlahPeminjamanProses = Peminjaman::where('status', 'Diproses')->count();
        $jumlahPengembalianProses = Pengembalian::where('status', 'Diproses')->count();
        $jumlahPenghancuranProses = Penghancuran::where('status', 'Diproses')->count();
        $jumlahRequestProses = $jumlahPeminjamanProses + $jumlahPengembalianProses + $jumlahPenghancuranProses;

        $jumlahUser = User::where('role', 'user')->count();

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'pengguna' => $pengguna,
            'jumlahAdmin' => $jumlahAdmin,
            'jumlahPeminjaman' => $jumlahPeminjaman,
            'jumlahPengembalian' => $jumlahPengembalian,
            'jumlahPenghancuran' => $jumlahPenghancuran,
            'jumlahRequestProses' => $jumlahRequestProses,
            'jumlahUser' => $jumlahUser
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
    public function show(string $id)
    {
        //
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

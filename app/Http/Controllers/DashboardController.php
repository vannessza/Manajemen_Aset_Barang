<?php

namespace App\Http\Controllers;

use App\Models\AsetDetail;
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
        $asetDetail = AsetDetail::all();

        if ($pengguna->role === 'adminsuper') {
            $jumlahAdmin = User::where('role', 'admin')->count();
            $jumlahPeminjaman = Peminjaman::where('status', 'Diterima')->count();
            $jumlahPengembalian = Pengembalian::where('status', 'Dikembalikan')->count();
            $jumlahPenghancuran = Penghancuran::where('status', 'Disetujui')->count();
            
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

        if ($pengguna->role === 'user') {
            $jumlahAsetDetail = $asetDetail->count();
            $jumlahPeminjaman = $pengguna->peminjaman()->where('status', 'Diterima')->count();
            $jumlahPengembalian = $pengguna->peminjaman()->where('status', 'Dikembalikan')->count();

            return view('dashboard.index', [
                'title' => 'Dashboard',
                'pengguna' => $pengguna,
                'jumlahAsetDetail' => $jumlahAsetDetail,
                'jumlahPeminjaman' => $jumlahPeminjaman,
                'jumlahPengembalian' => $jumlahPengembalian,
            ]);
        }

        if ($pengguna->role === 'admin') {
            $jumlahAsetDetail = $asetDetail->count();
            $jumlahPeminjaman = Peminjaman::where('status', 'Diterima')->count();
            $jumlahPengembalian = Pengembalian::where('status', 'Dikembalikan')->count();

            $jumlahPeminjamanProses = Peminjaman::where('status', 'Diproses')->count();
            $jumlahPengembalianProses = Pengembalian::where('status', 'Diproses')->count();

            $jumlahRequestProses = $jumlahPeminjamanProses + $jumlahPengembalianProses;
            
            $jumlahUser = User::where('role', 'user')->count();

            return view('dashboard.index', [
                'title' => 'Dashboard',
                'pengguna' => $pengguna,
                'jumlahAsetDetail' => $jumlahAsetDetail,
                'jumlahPeminjaman' => $jumlahPeminjaman,
                'jumlahPengembalian' => $jumlahPengembalian,
                'jumlahRequestProses' => $jumlahRequestProses,
                'jumlahUser' => $jumlahUser
            ]);
        }

        // Optional: Handle cases where the role is not 'adminsuper' or 'user'
        return redirect()->route('home')->with('error', 'Unauthorized access');
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

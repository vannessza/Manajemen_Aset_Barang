<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailRequestPenghancuran;
use App\Models\Penghancuran;
use App\Models\User;
use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenghancuranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $pengguna = Auth::user();
        $user = Auth::user();
        $penghancuran = Penghancuran::all();

        return view('dashboard.transaksi.penghancuran.index', compact('penghancuran', 'user'), [
            'title' => 'Penghancuran',
            'pengguna' => $pengguna
        ]);
    }

    public function penghancuran(Request $request){
        $pengguna = Auth::user();
        $search = $request->input('search');

        $penghancuran = Penghancuran::where('status', 'Disetujui')
            ->when($search, function ($query, $search) {
                return $query->where('nama_aset', 'like', '%' . $search . '%')
                            ->orWhereHas('tipePemusnahan', function ($query) use ($search) {
                                $query->where('tipePemusnahan', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('status', function ($query) use ($search) {
                                $query->where('status', 'like', '%' . $search . '%');
                            });
            })->paginate(10);

        return view('dashboard.transaksi.penghancuran.penghancuran', [
            'penghancuran' => $penghancuran,
            'title' => 'Peminjaman',
            'pengguna' => $pengguna
        ]);
    }

    public function history(Request $request){
        $user = Auth::user();
        $search = $request->input('search');

        $penghancuran = Penghancuran::latest()
            ->when($search, function ($query, $search) {
                return $query->where('nama_aset', 'like', '%' . $search . '%')
                            ->orWhereHas('tipePemusnahan', function ($query) use ($search) {
                                $query->where('tipePemusnahan', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('status', function ($query) use ($search) {
                                $query->where('status', 'like', '%' . $search . '%');
                            });
            })
            ->paginate(10);

        return view('dashboard.transaksi.penghancuran.history', compact('penghancuran', 'user'), [
            'title' => 'penghancuran',
            'pengguna' => $user
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
            'title' => 'Create Penghancuran',
            'pengguna' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $adminsuper = User::where('role', 'adminsuper')->get();
        $existingPenghancuran = Penghancuran::where('nama_aset', $request->namaAset)
            ->where('status', 'Diproses')
            ->first();

        if ($existingPenghancuran) {
            return back()->withErrors(['nama_aset' => 'Aset yang dipilih sedang diproses']);
        }

        $status = $request->image ? "Disetujui" : "Diproses";

        $dataPenghancuran = Penghancuran::create([
            'aset_id' => $request->aset,
            'nama_aset' => $request->namaAset,
            'tipePemusnahan' => $request->tipePemusnahan,
            'tglPemusnahan' => $request->tglPemusnahan,
            'status' => $status,
            'pemohon' => $user->id,
            'keterangan' => "Sedang diproses",
        ]);

        $dataPenghancuran->save();

        // Iterasi melalui setiap adminsuper dan kirim email
        foreach ($adminsuper as $admin) {
            $data['email'] = $admin->email;
            $data['request'] = "Penghancuran";
            $data['aset'] = $dataPenghancuran->aset->namaAset;
            $data['nama_aset'] = $dataPenghancuran->nama_aset;
            $data['tipePemusnahan'] = $dataPenghancuran->tipePemusnahan;
            $data['tglPemusnahan'] = $dataPenghancuran->tglPemusnahan;
            $data['pemohon'] = $dataPenghancuran->userpemohon->name;

            dispatch(new SendEmailRequestPenghancuran($data));
        }

        return redirect(route('penghancuran.history'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengguna = Auth::user();
        $penghancuran = Penghancuran::findOrFail($id);

        return view('dashboard.transaksi.penghancuran.showpenghancuran', compact('penghancuran'), [
            'title' => 'Detail Penghancuran',
            'pengguna' => $pengguna
        ]);
    }


    public function showhistory($id){
        $pengguna = Auth::user();
        $penghancuran = Penghancuran::findOrFail($id);

        return view('dashboard.transaksi.penghancuran.showhistorypenghancuran', compact('penghancuran'), [
            'title' => 'Detail Penghancuran',
            'pengguna' => $pengguna
        ]);
    }

    public function exportformulirbukti($id){
        $penghancuran = Penghancuran::findOrFail($id);

        // Pastikan gambar tersedia
        if (!Storage::disk('public')->exists($penghancuran->image)) {
            abort(404);
        }

        // Path lengkap file gambar
        $path = storage_path('app/public/' . $penghancuran->image);

        // Mendapatkan nama file gambar
        $filename = pathinfo($path, PATHINFO_FILENAME);

        // Mendapatkan ekstensi file gambar
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        // Buat nama file yang unik dengan ekstensi yang benar
        $downloadFileName = $filename . '.' . $extension;

        // Unduh file gambar
        return response()->file($path, ['Content-Disposition' => 'attachment; filename="' . $downloadFileName . '"']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        $penghancuran = Penghancuran::findOrFail($id);
        $aset = Aset::with('AsetDetail')->get();

        return view('dashboard.transaksi.penghancuran.penghancuranedit', compact('user', 'aset', 'penghancuran'),[
            'title' => 'Edit Penghancuran',
            'pengguna' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $adminsuper = User::where('role', 'adminsuper')->get();
        $dataPenghancuran = Penghancuran::findOrFail($id);
        
        // Periksa apakah ada penghancuran dengan nama aset yang sama dan status 'Diproses'
        $existingPenghancuran = Penghancuran::where('nama_aset', $request->namaAset)
            ->where('status', 'Diproses')
            ->first();

        if ($existingPenghancuran && $existingPenghancuran->id != $id) {
            return back()->withErrors(['nama_aset' => 'Aset yang dipilih sedang diproses']);
        }

        // Tentukan status berdasarkan apakah ada gambar yang diunggah
        $status = $request->hasFile('image') ? "Disetujui" : "Diproses";

        // Update data penghancuran
        $dataPenghancuran->update([
            'aset_id' => $request->aset,
            'nama_aset' => $request->namaAset,
            'tipePemusnahan' => $request->tipePemusnahan,
            'tglPemusnahan' => $request->tglPemusnahan,
            'status' => $status,
            'pemohon' => $user->id,
            'keterangan' => "Sedang diproses",
        ]);

        // Iterasi melalui setiap adminsuper dan kirim email
        foreach ($adminsuper as $admin) {
            $data = [
                'email' => $admin->email,
                'request' => "Penghancuran",
                'aset' => $dataPenghancuran->aset->namaAset,
                'nama_aset' => $dataPenghancuran->nama_aset,
                'tipePemusnahan' => $dataPenghancuran->tipePemusnahan,
                'tglPemusnahan' => $dataPenghancuran->tglPemusnahan,
                'pemohon' => $user->name,
            ];

            dispatch(new SendEmailRequestPenghancuran($data));
        }

        return redirect(route('penghancuran.history'));
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

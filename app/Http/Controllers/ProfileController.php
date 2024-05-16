<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailRequest;
use App\Jobs\SendEmailRequestRespon;
use App\Models\Divisi;
use App\Models\History;
use App\Models\Notification;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $peminjamanDiterima = $user->peminjaman()->where('status', 'Diterima')->get();
        $pengembalianDikembalikan = $user->pengembalian()->where('status', 'Dikembalikan')->get();

        $jumlahPeminjaman = $peminjamanDiterima->count();
        $jumlahPengembalian = $pengembalianDikembalikan->count();

        return view('dashboard.profile.index', compact('user', 'jumlahPeminjaman', 'jumlahPengembalian'), [
            'title' => 'User',
            'pengguna' => $user
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();

        $divisi = Divisi::all();

        return view('dashboard.profile.profileedit', compact('divisi', 'user'), [
            'title' => 'Edit Profile',
            'pengguna' => $user
        ]);
    }

    public function editpassword(){
        $user = Auth::user();

        return view('dashboard.profile.editpassword', compact( 'user'), [
            'title' => 'Edit Password',
            'pengguna' => $user
        ]);
    }

    public function daftaraset(Request $request){
        $user = Auth::user();

        $search = $request->input('search');

        $pengembalian = $user->pengembalian()->where('status', 'Dikembalikan')->get();
        $peminjaman = $user->peminjaman()->where('status', 'Diterima')
            ->when($search, function ($query, $search) {
                return $query->where('kodePeminjaman', 'like', '%' . $search . '%')
                            ->orWhereHas('user', function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('asetDetail', function ($query) use ($search) {
                                $query->where('namaAset', 'like', '%' . $search . '%');
                            });
            })->paginate(10);

        $jumlahPeminjaman = $peminjaman->count();
        $jumlahPengembalian = $pengembalian->count();
        


        return view('dashboard.profile.daftaraset.daftaraset', compact( 'user', 'peminjaman', 'jumlahPeminjaman', 'jumlahPengembalian'), [
            'title' => 'Profile',
            'pengguna' => $user
        ]);
    }

    public function daftarasetshow($id){
        $pengguna = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);

        return view('dashboard.profile.daftaraset.showdaftaraset', compact('peminjaman'), [
            'title' => 'Detail Peminjaman',
            'pengguna' => $pengguna
        ]);
    }

    public function history(Request $request){
        $user = Auth::user();

        $search = $request->input('search');

        $peminjaman = $user->peminjaman()->where('status', 'Diterima')->get();
        $pengembalian = $user->pengembalian()->where('status', 'Dikembalikan')->get();

        $jumlahPeminjaman = $peminjaman->count();
        $jumlahPengembalian = $pengembalian->count();

        $history = History::latest()
            ->when($search, function ($query, $search) {
                return $query->where('user', function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('asetDetail', function ($query) use ($search) {
                                $query->where('namaAset', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('action', 'like', '%' . $search . '%')
                            ->orWhereHas('keterangan', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('dashboard.profile.history', compact( 'user', 'history', 'jumlahPeminjaman', 'jumlahPengembalian'), [
            'title' => 'Profile',
            'pengguna' => $user
        ]);
    }

    public function pengembalian($id, Request $request)
    {
        $user = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);

        // Cek apakah sudah ada pengembalian untuk peminjaman ini dan statusnya masih Diproses
        $existingPengembalian = Pengembalian::where('kodePengembalian', $peminjaman->kodePeminjaman)
                                            ->where('status', 'Diproses')
                                            ->first();

        if ($existingPengembalian) {
            return back()->withErrors('Pengembalian sedang diproses atau telah selesai.');
        }

        // Atur tanggal pengembalian sebagai hari ini
        $tglPengembalian = Carbon::now()->toDateString();

        $notification = Notification::all();

        $dataPengembalian = Pengembalian::create([
            'user_id' => $peminjaman->user_id,
            'aset_id' => $peminjaman->aset_id,
            'nama_aset_id' => $peminjaman->nama_aset_id,
            'kodePengembalian' => $peminjaman->kodePeminjaman,
            'tglPengembalian' => $tglPengembalian,
            'status' => "Diproses",
            'lokasi_id' => $peminjaman->lokasi_id,
            'keterangan' => "Sedang diproses"
        ]);

        $dataPengembalian->save();

        foreach ($notification as $admin) {
            $data['email'] = $admin->email;
            $data['request'] = "Pengembalian";
            $data['name'] = $dataPengembalian->user->name;
            $data['namaAset'] = $dataPengembalian->AsetDetail->namaAset;
            $data['kategori'] = $dataPengembalian->aset->namaAset;
            $data['tanggal'] = $dataPengembalian->tglPengembalian;
            $data['lokasi'] = $dataPengembalian->lokasi->alamat;

            dispatch(new SendEmailRequest($data));
        }

        return redirect(route('pengembalian.history.user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);

        $imagePath = $user->profile->image; // Mendapatkan path gambar lama

        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::delete($imagePath); // Hapus gambar lama jika ada
            }
            $imagePath = $request->file('image')->store('user-images'); // Simpan gambar baru
        }

        // Perbarui profil pengguna yang sudah ada atau buat profil baru jika belum ada
        if ($user->profile) {
            $user->profile()->update([
                'divisi_id' => $request->divisi,
                'alamat' => $request->alamat,
                'noTelp' => $request->noTelp,
                'image' => $imagePath
            ]);
        } else {
            $user->profile()->create([
                'divisi_id' => $request->divisi,
                'alamat' => $request->alamat,
                'noTelp' => $request->noTelp,
                'image' => $imagePath
            ]);
        }

        return redirect(route('profile.index'));
    }

    public function storepassword(Request $request){
        // Validasi input dengan pesan error dalam bahasa Indonesia
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'Kolom password wajib diisi.',
            'password.min' => 'Panjang password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);
    
        // Simpan password baru
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->route('profile.index')->with('success', 'Password berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

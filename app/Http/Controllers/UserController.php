<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailRequestRespon;
use App\Models\Aset;
use App\Models\AsetDetail;
use App\Models\Divisi;
use App\Models\History;
use App\Models\Lokasi;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
    {
        $pengguna = Auth::user();
        $search = $request->input('search');

        // Mengambil semua pengguna dengan peran 'user'
        $user = User::where('role', 'user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10);

        $jumlahPeminjaman = [];

        // Melakukan perulangan untuk setiap pengguna
        foreach ($user as $us) {
            // Menghitung jumlah peminjaman untuk setiap pengguna
            $jumlah = Peminjaman::where('user_id', $us->id)
            ->where('status', 'Diterima')
            ->count();
            
            // Menyimpan jumlah peminjaman ke dalam array
            $jumlahPeminjaman[$us->id] = $jumlah;
        }

        return view('dashboard.akun.user.index', compact('user', 'jumlahPeminjaman'), [
            'title' => 'User',
            'pengguna' => $pengguna
        ]);
    }

     


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengguna = Auth::user();
        $divisi = Divisi::all();

        return view('dashboard.akun.user.usercreate', compact('divisi'), [
            'title' => 'create user',
            'pengguna' => $pengguna
        ]);
    }

    public function tambahaset($id){
        $pengguna = Auth::user();
        $user = User::findOrFail($id);
        $aset = Aset::all();
        $lokasi = Lokasi::all();

        return view('dashboard.akun.user.daftaraset.tambahasetcreate', compact('user', 'aset', 'lokasi'), [
            'title' => 'Tambah Aset',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'divisi' => 'required',
            'alamat' => 'required|string|max:255',
            'noTelp' => 'required|string|max:20',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
        ], [
            'nama.required' => 'Kolom nama wajib diisi.',
            'nama.string' => 'Kolom nama harus berupa teks.',
            'nama.max' => 'Panjang nama tidak boleh melebihi 255 karakter.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Kolom password wajib diisi.',
            'password.min' => 'Panjang password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'divisi.required' => 'Kolom divisi wajib diisi.',
            'alamat.required' => 'Kolom alamat wajib diisi.',
            'alamat.string' => 'Kolom alamat harus berupa teks.',
            'alamat.max' => 'Panjang alamat tidak boleh melebihi 255 karakter.',
            'noTelp.required' => 'Kolom nomor telepon wajib diisi.',
            'noTelp.string' => 'Kolom nomor telepon harus berupa teks.',
            'noTelp.max' => 'Panjang nomor telepon tidak boleh melebihi 20 karakter.',
            'image.required' => 'Kolom foto wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format file harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ]);

        // Simpan gambar baru
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user-images');
        } else {
            $imagePath = null;
        }

        // Simpan data user
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'User'
        ]);

        // Simpan data profil user
        $userProfile = UserProfile::create([
            'user_id' => $user->id,
            'divisi_id' => $request->divisi,
            'alamat' => $request->alamat,
            'noTelp' => $request->noTelp,
            'image' => $imagePath
        ]);

        // Redirect ke halaman indeks user
        return redirect(route('user.index'))->with('success', 'User berhasil dibuat.');
    }



    public function tambahasetstore($id, Request $request)
    {
        // Validasi input
        $user = User::findOrFail($id);
        $request->validate([
            'keterangan' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
        ]);

        // Membuat nomor urut baru untuk peminjaman
        $nomerUrutBarang = str_pad(Peminjaman::count() + 1, 4, '0', STR_PAD_LEFT);

        // Mendapatkan kode aset, kode divisi, dan kode lokasi
        $aset = Aset::findOrFail($request->aset);
        $divisi = User::findOrFail($id)->profile->divisi->kodeDivisi;
        $lokasi = Lokasi::findOrFail($request->lokasi);

        // Menentukan status berdasarkan apakah ada gambar atau tidak
        $status = $request->hasFile('image') ? "Diterima" : "Diproses";

        // Jika ada file gambar di-upload, simpan gambar tersebut dan buat kode peminjaman baru
        if ($request->hasFile('image')) {
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('peminjaman-images');

            // Membuat kode peminjaman dengan format yang diminta
            $kodePeminjaman = $nomerUrutBarang . '/' . $aset->kodeAset . '/' . $divisi . '/' . $lokasi->kodeLokasi;
        } else {
            // Jika tidak ada gambar yang diunggah, tidak perlu membuat kode peminjaman
            $imagePath = null;
            $kodePeminjaman = null;
        }

        // Membuat entri peminjaman baru
        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'aset_id' => $request->aset,
            'nama_aset_id' => $request->namaAset,
            'kodePeminjaman' => $kodePeminjaman,
            'tglPeminjaman' => $request->tglPeminjaman,
            'status' => $status,
            'lokasi_id' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'image' => $imagePath
        ]);

        // Membuat log kegiatan (history) setelah peminjaman diterima
        if ($status === 'Diterima') {
            $history = History::create([
                'user_id' => $peminjaman->user_id,
                'aset_detail_id' => $peminjaman->nama_aset_id,
                'action' => 'Peminjaman',
                'keterangan' => 'Peminjaman ' . $aset->namaAset . ' diterima pada ' . now()->toDateTimeString()
            ]);

            $data['email'] = $peminjaman->user->email;
            $data['respon'] = "Diterima";
            $data['request'] = "Peminjaman";
            $data['name'] = $peminjaman->user->name;
            $data['namaAset'] = $peminjaman->AsetDetail->namaAset;
            $data['kategori'] = $peminjaman->aset->namaAset;
            $data['tanggal'] = $peminjaman->tglPeminjaman;
            $data['lokasi'] = $peminjaman->lokasi->alamat;
            $data['keterangan'] = $peminjaman->keterangan;
        
            dispatch(new SendEmailRequestRespon($data));
                // Mengecek jumlah peminjaman dengan nama_aset_id yang sama
        $jumlahPeminjaman = Peminjaman::where('nama_aset_id', $request->namaAset)
        ->where('status', 'Diterima')
        ->count();
            // Mendapatkan jumlah aset pada AsetDetail dengan id yang sama
            $asetDetail = AsetDetail::findOrFail($request->namaAset);

            // Mengubah status aset detail menjadi tidak tersedia jika jumlah peminjaman sama dengan jumlah aset pada AsetDetail
            if ($jumlahPeminjaman >= $asetDetail->jumlah) {
            $asetDetail->update([
            'status' => 'Tidak Tersedia'
            ]);
            } else {
            $asetDetail->update([
            'status' => 'Tersedia'
            ]);
            }
            return redirect(route('user.show.daftaraset', $user->id));
        }else{
            return redirect(route('user.show.history', $user->id));
        }
        
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengguna = Auth::user();
        $user = User::findOrFail($id);

        $peminjaman = Peminjaman::where('user_id', $id)->get();

        $jumlahPeminjaman = $user->peminjaman()->count();
        $jumlahPengembalian = $user->pengembalian()->count();

        return view('dashboard.akun.user.showuser', compact('user', 'peminjaman', 'jumlahPeminjaman', 'jumlahPengembalian'),[
            'title' => 'Detail User',
            'pengguna' => $pengguna
        ]);
    }

    public function daftaraset($id, Request $request)
    {
        $pengguna = Auth::user();
        $user = User::findOrFail($id);
        $search = $request->input('search');

        // Filter data peminjaman dengan status "Diterima" dan milik pengguna yang sedang login
        $peminjaman = Peminjaman::where('status', 'Diterima')
            ->where('user_id', $user->id)
            ->when($search, function ($query, $search) {
                return $query->where(function($query) use ($search) {
                    $query->where('kodePeminjaman', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('asetDetail', function ($query) use ($search) {
                            $query->where('namaAset', 'like', '%' . $search . '%');
                        });
                });
            })
            ->paginate(10);

        $jumlahPeminjaman = $user->peminjaman()->count();
        $jumlahPengembalian = $user->pengembalian()->count();

        return view('dashboard.akun.user.daftaraset.daftaraset', compact('user', 'peminjaman', 'jumlahPeminjaman', 'jumlahPengembalian'),[
            'title' => 'Detail User',
            'pengguna' => $pengguna
        ]);
    }


    public function history($id, Request $request){
        $pengguna = Auth::user();

        $user = User::findOrFail($id);

        $search = $request->input('search');


        $peminjaman = $user->peminjaman()->latest()->where('user_id', $user->id) ->when($search, function ($query, $search) {
            return $query->where('kodePeminjaman', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('asetDetail', function ($query) use ($search) {
                            $query->where('namaAset', 'like', '%' . $search . '%');
                        });
        })
        ->paginate(10);

        $jumlahPeminjaman = $user->peminjaman()->count();
        $jumlahPengembalian = $user->pengembalian()->count();

        return view('dashboard.akun.user.daftaraset.history', compact('user', 'peminjaman', 'jumlahPeminjaman', 'jumlahPengembalian'),[
            'title' => 'Detail User',
            'pengguna' => $pengguna
        ]);
    }

    public function daftarasetshow($user_id, $peminjaman_id){
        $pengguna = Auth::user();

        $user = User::findOrFail($user_id);

        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        return view('dashboard.akun.user.daftaraset.showdaftaraset', compact('user', 'peminjaman'),[
            'title' => 'Detail Daftar Aset',
            'pengguna' => $pengguna
        ]);
    }

    public function hsitoryshow($user_id, $peminjaman_id){
        $pengguna = Auth::user();

        $user = User::findOrFail($user_id);

        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        return view('dashboard.akun.user.daftaraset.showhistory', compact('user', 'peminjaman'),[
            'title' => 'Detail History',
            'pengguna' => $pengguna
        ]);
    }

    public function exportformulir($user_id, $peminjaman_id){
        $user = User::findOrFail($user_id);
        $userPemberi = Auth::user();
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        // Set lokalitas Carbon ke bahasa Indonesia
        App::setLocale('id');

        $hari = Carbon::parse($peminjaman->tglPeminjaman)->translatedFormat('l');

        $tglPeminjaman = Carbon::parse($peminjaman->tglPeminjaman)->translatedFormat('j F Y');

        $templatePeminjaman = new TemplateProcessor('word-template/peminjaman.docx');
        $templatePeminjaman->setValue('id', $peminjaman->id);
        $templatePeminjaman->setValue('tanggal', $tglPeminjaman);
        $templatePeminjaman->setValue('hari', $hari);
        $templatePeminjaman->setValue('jenisAset', $peminjaman->aset->namaAset);
        $templatePeminjaman->setValue('merek', $peminjaman->asetDetail->namaAset);
        $templatePeminjaman->setValue('kodeAset', $peminjaman->aset->kodeAset);
        $templatePeminjaman->setValue('namaPemberi', $userPemberi->name);
        $templatePeminjaman->setValue('divisiPemberi', $userPemberi->profile->divisi->namaDivisi);
        $templatePeminjaman->setValue('namaPenerima', $user->name);
        $templatePeminjaman->setValue('divisiPenerima', $user->profile->divisi->namaDivisi);
        $fileName = $user->name;
        $templatePeminjaman->saveAs('peminjaman'.$fileName.'.docx');
        
        return response()->download('peminjaman'.$fileName.'.docx')->deleteFileAfterSend(true);

    }

    public function exportformulirbukti($user_id, $peminjaman_id)
    {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        // Pastikan gambar tersedia
        if (!Storage::disk('public')->exists($peminjaman->image)) {
            abort(404);
        }

        // Path lengkap file gambar
        $path = storage_path('app/public/' . $peminjaman->image);

        // Mendapatkan nama file gambar
        $filename = pathinfo($path, PATHINFO_FILENAME);

        // Mendapatkan ekstensi file gambar
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        // Buat nama file yang unik dengan ekstensi yang benar
        $downloadFileName = $filename . '.' . $extension;

        // Unduh file gambar
        return response()->file($path, ['Content-Disposition' => 'attachment; filename="' . $downloadFileName . '"']);
    }


    public function uploadformulir($user_id, $peminjaman_id){
        $pengguna = Auth::user();

        $user = User::findOrFail($user_id);

        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        return view('dashboard.akun.user.daftaraset.uploadformulir', compact('user', 'peminjaman'),[
            'title' => 'Upload Formulir',
            'pengguna' => $pengguna
        ]);
    }

    public function uploadformulirupdate($user_id, $peminjaman_id, Request $request){
        // Mencari peminjaman berdasarkan ID
        

        // Membuat nomor urut barang baru dengan format 4 digit menggunakan ID
        $request->validate([
            'keterangan' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048',
        ], [
            'keterangan.required' => 'Kolom keterangan wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format file harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ]);

        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
        // Cek status aset detail
        $asetDetail = AsetDetail::findOrFail($peminjaman->nama_aset_id);
        if ($asetDetail->status == 'Tidak Tersedia') {
            return back()->withErrors(['namaAset' => 'Aset yang dipilih tidak tersedia.']);
        }

        $nomerUrutBarang = str_pad($peminjaman->id, 4, '0', STR_PAD_LEFT);

        // Mendapatkan kode aset, kode divisi, dan kode lokasi
        $aset = Aset::findOrFail($peminjaman->aset_id);
        $divisi = User::findOrFail($peminjaman->user_id)->profile->divisi->kodeDivisi;
        $lokasi = Lokasi::findOrFail($peminjaman->lokasi_id);

        // Menentukan status berdasarkan apakah ada gambar atau tidak
        $status = $request->hasFile('image') ? "Diterima" : "Diproses";

        // Validasi input
        $request->validate([
            'keterangan' => 'required|string',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,docx', // Max 2MB
        ]);

        // Jika ada file gambar di-upload, simpan gambar tersebut dan perbarui kode peminjaman
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($peminjaman->image) {
                Storage::delete($peminjaman->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('peminjaman-images');

            // Membuat kode peminjaman dengan format yang diminta
            $kodePeminjaman = $nomerUrutBarang . '/' . $aset->kodeAset . '/' . $divisi . '/' . $lokasi->kodeLokasi;
        } else {
            // Jika tidak ada gambar yang diunggah, gunakan kode peminjaman yang sudah ada
            $imagePath = $peminjaman->image;
            $kodePeminjaman = $peminjaman->kodePeminjaman;
        }

        // Memperbarui data peminjaman
        $peminjaman->update([
            'keterangan' => $request->keterangan,
            'image' => $imagePath,
            'status' => $status,
            'kodePeminjaman' => $kodePeminjaman,
        ]);

        // Membuat log kegiatan (history) setelah peminjaman diterima
        if ($status === 'Diterima') {
            $history = History::create([
                'user_id' => $peminjaman->user_id,
                'aset_detail_id' => $peminjaman->nama_aset_id,
                'action' => 'Peminjaman',
                'keterangan' => 'Peminjaman ' . $aset->namaAset . ' diterima pada ' . now()->toDateTimeString()
            ]);

            $data['email'] = $peminjaman->user->email;
            $data['respon'] = "Diterima";
            $data['request'] = "Peminjaman";
            $data['name'] = $peminjaman->user->name;
            $data['namaAset'] = $peminjaman->AsetDetail->namaAset;
            $data['kategori'] = $peminjaman->aset->namaAset;
            $data['tanggal'] = $peminjaman->tglPeminjaman;
            $data['lokasi'] = $peminjaman->lokasi->alamat;
            $data['keterangan'] = $peminjaman->keterangan;
        
            dispatch(new SendEmailRequestRespon($data));
                // Mengecek jumlah peminjaman dengan nama_aset_id yang sama
            $jumlahPeminjaman = Peminjaman::where('nama_aset_id', $peminjaman->nama_aset_id)
            ->where('status', 'Diterima')
            ->count();
            // Mendapatkan jumlah aset pada AsetDetail dengan id yang sama
            $asetDetail = AsetDetail::findOrFail($peminjaman->nama_aset_id);

            // Mengubah status aset detail menjadi tidak tersedia jika jumlah peminjaman sama dengan jumlah aset pada AsetDetail
            if ($jumlahPeminjaman >= $asetDetail->jumlah) {
            $asetDetail->update([
            'status' => 'Tidak Tersedia'
            ]);
            } else {
            $asetDetail->update([
            'status' => 'Tersedia'
            ]);
            }
        }
        return redirect(route('user.show.daftaraset.showhistory', ['user_id' => $user_id, 'peminjaman_id' => $peminjaman_id]));
    }

    public function pengembalian($user_id, $peminjaman_id){
        $pengguna = Auth::user();
        $user = User::findOrFail($user_id);
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
        $lokasi = Lokasi::all();

        return view('dashboard.akun.user.daftaraset.pengembalian', compact('user', 'peminjaman', 'lokasi'),[
            'title' => 'pengembalian',
            'pengguna' => $pengguna
        ]);
    }
    
    public function exportformulirpengembalian($user_id, $peminjaman_id)
    {
        $user = User::findOrFail($user_id);
        $userPemberi = Auth::user();
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);
    
        // Set lokalitas Carbon ke bahasa Indonesia
        App::setLocale('id');
    
        // Mendapatkan tanggal dan hari saat ini
        $tglPembuatanDokumen = Carbon::now()->translatedFormat('j F Y');
        $hariPembuatanDokumen = Carbon::now()->translatedFormat('l');
    
        $templatePeminjaman = new TemplateProcessor('word-template/pengembalian.docx');
        $templatePeminjaman->setValue('id', $peminjaman->id);
        $templatePeminjaman->setValue('tanggal', $tglPembuatanDokumen);
        $templatePeminjaman->setValue('hari', $hariPembuatanDokumen);
        $templatePeminjaman->setValue('jenisAset', $peminjaman->aset->namaAset);
        $templatePeminjaman->setValue('merek', $peminjaman->asetDetail->namaAset);
        $templatePeminjaman->setValue('kodeAset', $peminjaman->aset->kodeAset);
        $templatePeminjaman->setValue('namaPemberi', $userPemberi->name);
        $templatePeminjaman->setValue('divisiPemberi', $userPemberi->profile->divisi->namaDivisi);
        $templatePeminjaman->setValue('namaPenerima', $user->name);
        $templatePeminjaman->setValue('divisiPenerima', $user->profile->divisi->namaDivisi);
        $fileName = $user->name;
        $templatePeminjaman->saveAs('pengembalian'.$fileName.'.docx');
        
        return response()->download('pengembalian'.$fileName.'.docx')->deleteFileAfterSend(true);
    }

    public function pengembalianstore($user_id, $peminjaman_id, Request $request)
    {
        $user = User::findOrFail($user_id);
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        // Validasi
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,docx'
        ]);
        
        $status = $request->image ? "Dikembalikan" : "Diproses";

        // Simpan gambar baru
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pengembalian-images');
        } else {
            $imagePath = null;
        }

        // Atur tanggal pengembalian sebagai hari ini
        $tglPengembalian = Carbon::now()->toDateString();

        // Simpan data pengembalian
        $pengembalian = Pengembalian::create([
            'user_id' => $peminjaman->user_id,
            'aset_id' => $peminjaman->aset_id,
            'nama_aset_id' => $peminjaman->nama_aset_id,
            'kodePengembalian' => $peminjaman->kodePeminjaman,
            'tglPengembalian' => $tglPengembalian,
            'status' => "Dikembalikan",
            'lokasi_id' => $peminjaman->lokasi_id,
            'keterangan' => $request->keterangan,
            'image' => $imagePath,
        ]);

        $pengembalian->save();

        if ($status === 'Dikembalikan') {
            $history = History::create([
                'user_id' => $pengembalian->user_id,
                'aset_detail_id' => $pengembalian->nama_aset_id,
                'action' => 'Pengembalian',
                'keterangan' => 'Pengembalian ' . $pengembalian->aset->namaAset . ' dibuat pada ' . now()->toDateTimeString()
            ]);

            $peminjaman->update([
                'status' => 'Dikembalikan'
            ]);
                

            $data['email'] = $pengembalian->user->email;
            $data['respon'] = "Diterima";
            $data['request'] = "Pengembalian";
            $data['name'] = $pengembalian->user->name;
            $data['namaAset'] = $pengembalian->AsetDetail->namaAset;
            $data['kategori'] = $pengembalian->aset->namaAset;
            $data['tanggal'] = $pengembalian->tglPeminjaman;
            $data['lokasi'] = $pengembalian->lokasi->alamat;
            $data['keterangan'] = $pengembalian->keterangan;
        
            dispatch(new SendEmailRequestRespon($data));
                // Mengecek jumlah peminjaman dengan nama_aset_id yang sama
            $jumlahPeminjaman = Peminjaman::where('nama_aset_id', $pengembalian->nama_aset_id)
            ->where('status', 'Diterima')
            ->count();
            // Mendapatkan jumlah aset pada AsetDetail dengan id yang sama
            $asetDetail = AsetDetail::findOrFail($pengembalian->nama_aset_id);

            // Mengubah status aset detail menjadi tidak tersedia jika jumlah peminjaman sama dengan jumlah aset pada AsetDetail
            if ($jumlahPeminjaman == $asetDetail->jumlah) {
            $asetDetail->update([
            'status' => 'Tidak Tersedia'
            ]);
            } else {
            $asetDetail->update([
            'status' => 'Tersedia'
            ]);
            }
             return redirect(route('pengembalian.datapengembalian'));
        }else{
             return redirect(route('pengembalian.history'));
        }
        
    }

    

    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengguna = Auth::user();

        $user = User::findOrFail($id);

        $divisi = Divisi::all();

        return view('dashboard.akun.user.useredit', compact('divisi', 'user'), [
            'title' => 'Edit user',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'divisi'=> $request->divisi,
            'role' => $request->role,
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

        return redirect(route('user.index'));
    }

    public function editpassword($id){

        $pengguna = Auth::user();

        $user = User::findOrFail($id);

        return view('dashboard.akun.user.userpasswordedit', compact('user'), [
            'title' => 'Edit Password',
            'pengguna' => $pengguna
        ]);
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
    
        return redirect()->route('user.edit', $user->id)->with('success', 'Password berhasil diubah.');
    }
    
    


    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
{
    $user = User::findOrFail($id);

    if ($user->profile->image) {
        Storage::delete($user->profile->image);
    }

    $user->delete();

    return redirect(route('user.index'));
}
}

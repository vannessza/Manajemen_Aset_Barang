<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Divisi;
use App\Models\Lokasi;
use App\Models\Peminjaman;
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

     public function index()
     {
         // Mengambil semua pengguna dengan peran 'user'
         $user = User::where('role', 'user')->get();
     
         // Mendefinisikan array untuk menyimpan jumlah peminjaman masing-masing pengguna
         $jumlahPeminjaman = [];
     
         // Melakukan perulangan untuk setiap pengguna
         foreach ($user as $us) {
             // Menghitung jumlah peminjaman untuk setiap pengguna
             $jumlah = Peminjaman::where('user_id', $us->id)->count();
             
             // Menyimpan jumlah peminjaman ke dalam array
             $jumlahPeminjaman[$us->id] = $jumlah;
         }
     
         return view('dashboard.akun.user.index', compact('user', 'jumlahPeminjaman'), [
             'title' => 'User'
         ]);
     }
     


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisi = Divisi::all();

        return view('dashboard.akun.user.usercreate', compact('divisi'), [
            'title' => 'create user'
        ]);
    }

    public function tambahaset($id){
        $user = User::findOrFail($id);
        $aset = Aset::all();
        $lokasi = Lokasi::all();

        return view('dashboard.akun.user.tambahasetcreate', compact('user', 'aset', 'lokasi'), [
            'title' => 'Tambah Aset'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'User'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user-images');
        }

        $UserProfile = UserProfile::create([
            'user_id' =>$user->id,
            'divisi_id' =>$request->divisi,
            'alamat' =>$request->alamat,
            'noTelp' => $request->noTelp,
            'image' => $imagePath
        ]);

        return redirect(route('user.index'));
    }

    public function tambahasetstore($id, Request $request){
        // Validasi input
        $user = User::findOrFail($id);
        $request->validate([
            'keterangan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048',
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
        Peminjaman::create([
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

        // Redirect ke halaman indeks permintaan
        return redirect(route('user.show.daftaraset', $user->id));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $peminjaman = Peminjaman::where('user_id', $id)->get();

        $jumlahPeminjaman = $user->peminjaman()->count();
        $jumlahPengembalian = $user->pengembalian()->count();

        return view('dashboard.akun.user.showuser', compact('user', 'peminjaman', 'jumlahPeminjaman', 'jumlahPengembalian'),[
            'title' => 'Detail User'
        ]);
    }

    public function daftaraset($id){

        $user = User::findOrFail($id);

        $peminjaman = Peminjaman::where('user_id', $id)->get();

        $jumlahPeminjaman = $user->peminjaman()->count();
        $jumlahPengembalian = $user->pengembalian()->count();

        return view('dashboard.akun.user.daftaraset', compact('user', 'peminjaman', 'jumlahPeminjaman', 'jumlahPengembalian'),[
            'title' => 'Detail User'
        ]);
    }

    public function daftarasetshow($user_id, $peminjaman_id){
        $user = User::findOrFail($user_id);

        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        return view('dashboard.akun.user.showdaftaraset', compact('user', 'peminjaman'),[
            'title' => 'Detail Daftar Aset'
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
        $user = User::findOrFail($user_id);

        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        return view('dashboard.akun.user.uploadformulir', compact('user', 'peminjaman'),[
            'title' => 'Upload Formulir'
        ]);
    }

    public function uploadformulirupdate($user_id, $peminjaman_id, Request $request){
        // Mencari peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        // Membuat nomor urut barang baru dengan format 4 digit menggunakan ID
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:2048', // Max 2MB
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

        // Redirect ke halaman indeks permintaan
        return redirect(route('user.show.daftaraset.show', ['user_id' => $user_id, 'peminjaman_id' => $peminjaman_id]));
    }

    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $divisi = Divisi::all();

        return view('dashboard.akun.user.useredit', compact('divisi', 'user'), [
            'title' => 'Edit user'
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
            'role' => 'user'
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

        $user = User::findOrFail($id);

        return view('dashboard.akun.user.userpasswordedit', compact('user'), [
            'title' => 'Edit Password'
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

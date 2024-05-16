<?php

namespace App\Http\Controllers;


use App\Jobs\SendEmailRequest;
use App\Jobs\SendEmailRequestRespon;
use App\Models\AsetDetail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aset;
use App\Models\History;
use App\Models\Lokasi;
use App\Models\Notification;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna = Auth::user();
        $pengembalian = Pengembalian::all();

        return view('dashboard.transaksi.pengembalian.index', compact('pengembalian'), [
            'title' => 'Pengembalian',
            'pengguna' => $pengguna
        ]);
    }

    public function indexuser(){
        $user = Auth::user();
        $pengembalian = $user->pengembalian;
    
        return view('dashboard.transaksi.pengembalianuser.pengembalian', compact('pengembalian'), [
            'title' => 'Pengembalian',
            'pengguna' => $user
        ]);
    }

    public function datapengembalian(){
        $user = Auth::user();
        $pengembalian = $user->pengembalian->filter(function ($pengembalian){
            return $pengembalian->status === "Dikembalikan";
        });
    
        return view('dashboard.transaksi.pengembalianuser.pengembalian', compact('pengembalian', 'user'), [
            'title' => 'Pengembalian',
            'pengguna' => $user
        ]);
    }

    public function pengembalian(Request $request)
    {
        $pengguna = Auth::user();
        $search = $request->input('search');

        $pengembalian = Pengembalian::where('status', 'Dikembalikan')
            ->when($search, function ($query, $search) {
                return $query->where('kodePengembalian', 'like', '%' . $search . '%')
                            ->orWhereHas('user', function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('asetDetail', function ($query) use ($search) {
                                $query->where('namaAset', 'like', '%' . $search . '%');
                            });
            })->paginate(10);

        return view('dashboard.transaksi.pengembalian.pengembalian', [
            'pengembalian' => $pengembalian,
            'title' => 'Pengembalian',
            'pengguna' => $pengguna
        ]);
    }



    public function history(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        $pengembalian = Pengembalian::latest()
            ->when($search, function ($query, $search) {
                return $query->where('kodePengembalian', 'like', '%' . $search . '%')
                            ->orWhereHas('user', function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('asetDetail', function ($query) use ($search) {
                                $query->where('namaAset', 'like', '%' . $search . '%');
                            });
            })
            ->paginate(10);

        return view('dashboard.transaksi.pengembalian.history', compact('pengembalian', 'user'), [
            'title' => 'Pengembalian',
            'pengguna' => $user
        ]);
    }


    public function historyuser(){
        $user = Auth::user();
        $pengembalian = $user->pengembalian()->latest()->get();
    
        return view('dashboard.transaksi.pengembalianuser.history', compact('pengembalian', 'user'), [
            'title' => 'Pengembalian',
            'pengguna' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengguna = Auth::user();
        $lokasi = Lokasi::all();
        $pengembalian = Pengembalian::all();
        $peminjaman = Peminjaman::all();
        $peminjaman = $peminjaman->reject(function ($peminjaman) use ($pengembalian) {
            // Cek apakah peminjaman memiliki pengembalian yang sedang diproses
            return Pengembalian::where('kodePengembalian', $peminjaman->kodePeminjaman)
                                ->where('status', '!=', 'Selesai')
                                ->exists();
        });
        $uniqueUsers = $peminjaman->unique('user_id');
        return view('dashboard.transaksi.pengembalian.pengembaliancreate', compact('peminjaman', 'lokasi', 'uniqueUsers'),[
            'title' => 'Create Pengembalian',
            'pengguna' => $pengguna
        ]);
    }

    public function createuser()
    {
        $pengguna = Auth::user();
        $user = Auth::user();
        $pengembalian = Pengembalian::all();
        $peminjaman = $user->peminjaman->filter(function($peminjaman){
            return $peminjaman->status === "Diterima";
        });

        // Filter peminjaman yang belum memiliki pengembalian yang sedang diproses
        $peminjaman = $peminjaman->reject(function ($peminjaman) use ($pengembalian) {
            // Cek apakah peminjaman memiliki pengembalian yang sedang diproses
            return Pengembalian::where('kodePengembalian', $peminjaman->kodePeminjaman)
                                ->where('status', '!=', 'Selesai')
                                ->exists();
        });

        

        return view('dashboard.transaksi.pengembalianuser.pengembaliancreate', compact('user', 'peminjaman'), [
            'title' => 'Create Pengembalian',
            'pengguna' => $pengguna
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $peminjaman = Peminjaman::findOrFail($request->namaAset);

        $status = $request->image ? "Dikembalikan" : "Diproses";

        $request->validate([
            'keterangan' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048', // Max 2MB
        ]);

        // Menentukan status berdasarkan apakah ada gambar atau tidak
        $status = $request->hasFile('image') ? "Dikembalikan" : "Diproses";

        // Jika ada file gambar di-upload, simpan gambar tersebut
        $imagePath = $request->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pengembalian-images');
        }

        $pengembalian = Pengembalian::create([
            'user_id' => $request->namaPengembali,
            'aset_id' => $peminjaman->aset_id,
            'nama_aset_id' => $peminjaman->nama_aset_id,
            'kodePengembalian' => $peminjaman->kodePeminjaman,
            'tglPengembalian' => $request->tglPengembalian,
            'status' => $status,
            'lokasi_id' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'image' => $imagePath
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




    public function storeuser(Request $request){
        $peminjaman = Peminjaman::findOrFail($request->namaAset);

        $adminUsers = Notification::all();;

        $dataPengembalian = Pengembalian::create([
            'user_id' => $peminjaman->user_id,
            'aset_id' => $peminjaman->aset_id,
            'nama_aset_id' => $peminjaman->nama_aset_id,
            'kodePengembalian' => $peminjaman->kodePeminjaman,
            'tglPengembalian' => $request->tglPengembalian,
            'status' => "Diproses",
            'lokasi_id' => $peminjaman->lokasi_id,
            'keterangan' => "Sedang diproses"
        ]);

        $dataPengembalian->save();

        foreach ($adminUsers as $admin) {
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
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengguna = Auth::user();
        $pengembalian = Pengembalian::findOrFail($id);

        return view('dashboard.transaksi.pengembalian.showpengembalian', compact('pengembalian'), [
            'title' => 'Pengembalian',
            'pengguna' => $pengguna
        ]);
    }
    
    public function exportformulirbukti($id){
        $pengembalian = Pengembalian::findOrFail($id);

        // Pastikan gambar tersedia
        if (!Storage::disk('public')->exists($pengembalian->image)) {
            abort(404);
        }

        // Path lengkap file gambar
        $path = storage_path('app/public/' . $pengembalian->image);

        // Mendapatkan nama file gambar
        $filename = pathinfo($path, PATHINFO_FILENAME);

        // Mendapatkan ekstensi file gambar
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        // Buat nama file yang unik dengan ekstensi yang benar
        $downloadFileName = $filename . '.' . $extension;

        // Unduh file gambar
        return response()->file($path, ['Content-Disposition' => 'attachment; filename="' . $downloadFileName . '"']);
    }
    public function exportformulir($id){
        $userPemberi = Auth::user();
        $pengembalian = Pengembalian::findOrFail($id);
    
        // Set lokalitas Carbon ke bahasa Indonesia
        App::setLocale('id');
    
        // Mendapatkan tanggal dan hari saat ini
        $tglPembuatanDokumen = Carbon::now()->translatedFormat('j F Y');
        $hariPembuatanDokumen = Carbon::now()->translatedFormat('l');
    
        $templatePengembalian = new TemplateProcessor('word-template/pengembalian.docx');
        $templatePengembalian->setValue('id', $pengembalian->id);
        $templatePengembalian->setValue('tanggal', $tglPembuatanDokumen);
        $templatePengembalian->setValue('hari', $hariPembuatanDokumen);
        $templatePengembalian->setValue('jenisAset', $pengembalian->aset->namaAset);
        $templatePengembalian->setValue('merek', $pengembalian->asetDetail->namaAset);
        $templatePengembalian->setValue('kodeAset', $pengembalian->aset->kodeAset);
        $templatePengembalian->setValue('namaPemberi', $userPemberi->name);
        $templatePengembalian->setValue('divisiPemberi', $userPemberi->profile->divisi->namaDivisi);
        $templatePengembalian->setValue('namaPenerima', $pengembalian->user->name);
        $templatePengembalian->setValue('divisiPenerima', $pengembalian->user->profile->divisi->namaDivisi);
        $fileName = $pengembalian->user->name;
        $templatePengembalian->saveAs('pengembalian'.$fileName.'.docx');
        
        return response()->download('pengembalian'.$fileName.'.docx')->deleteFileAfterSend(true);
    }

    //  public function showuser($id){
    //      $pengguna = Auth::user();
    //      $pengembalian = Pengembalian::findOrFail($id);

    //      return view('dashboard.transaksi.pengembalianuser.showpengembalian', compact('pengembalian'), [
    //          'title' => 'Pengembalian',
    //          'pengguna' => $pengguna
    //      ]);   
    //  }
    public function showpengembalianuser($id){
        $pengguna = Auth::user();
        $pengembalian = Pengembalian::findOrFail($id);
        return view('dashboard.transaksi.pengembalianUser.showpengembalian', compact('pengembalian'), [
            'title' => 'Detail Pengembalian',
            'pengguna' => $pengguna
        ]);
    }

    public function showhistory($id){
        $pengguna = Auth::user();
        $pengembalian = Pengembalian::findOrFail($id);
        return view('dashboard.transaksi.pengembalian.showhistorypengembalian', compact('pengembalian'), [
            'title' => 'Detail Pengembalian',
            'pengguna' => $pengguna
        ]);
    }

    public function showhistoryuser($id){
        $pengguna = Auth::user();
        $pengembalian = Pengembalian::findOrFail($id);
        return view('dashboard.transaksi.pengembalianUser.showhistorypengembalian', compact('pengembalian'), [
            'title' => 'Detail Pengembalian',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengguna = Auth::user();
        $pengembalian = Pengembalian::findOrFail($id);
        $lokasi = Lokasi::all();
        $peminjaman = Peminjaman::all();
        $uniqueUsers = $peminjaman->unique('user_id');
        return view('dashboard.transaksi.pengembalian.pengembalianedit', compact('pengembalian', 'peminjaman', 'lokasi', 'uniqueUsers'),[
            'title' => 'Edit Pengembalian',
            'pengguna' => $pengguna
        ]);
    }
    

    public function edituser($id){
        $user = Auth::user();
        $pengembalian = Pengembalian::findOrFail($id);

        $peminjaman = $user->peminjaman->filter(function($peminjaman){
            return $peminjaman->status === "Diterima";
        });

        return view('dashboard.transaksi.pengembalianuser.pengembalianedit', compact('user', 'peminjaman', 'pengembalian'), [
            'title' => 'Edit Pengembalian',
            'pengguna' => $user
        ]);
    }

    public function updateuser($id, Request $request){
        $pengembalian = Pengembalian::findOrFail($id);
        $peminjaman = Peminjaman::findOrFail($request->namaAset);
        
        $adminUsers = Notification::all();;

        $pengembalian->update([
            'user_id' => $peminjaman->user_id,
            'aset_id' => $peminjaman->aset_id,
            'nama_aset_id' => $peminjaman->nama_aset_id,
            'kodePengembalian' => $peminjaman->kodePeminjaman,
            'tglPengembalian' => $request->tglPengembalian,
            'status' => "Diproses",
            'lokasi_id' => $peminjaman->lokasi_id,
            'keterangan' => "Sedang diproses"
        ]);

        $pengembalian->save();

        foreach ($adminUsers as $admin) {
            $data['email'] = $admin->email;
            $data['request'] = "Edit Pengembalian";
            $data['name'] = $pengembalian->user->name;
            $data['namaAset'] = $pengembalian->AsetDetail->namaAset;
            $data['kategori'] = $pengembalian->aset->namaAset;
            $data['tanggal'] = $pengembalian->tglPengembalian;
            $data['lokasi'] = $pengembalian->lokasi->alamat;
        
            dispatch(new SendEmailRequest($data));
        }

        return redirect(route('pengembalian.history.user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($request->namaAset);

        $pengembalian = Pengembalian::findOrFail($id);

        // $status = $request->image ? "Dikembalikan" : "Diproses";

        $request->validate([
            'keterangan' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:2048', // Max 2MB
        ]);

        // Menentukan status berdasarkan apakah ada gambar atau tidak
        $status = $request->hasFile('image') ? "Dikembalikan" : "Diproses";

        // Jika ada file gambar di-upload, simpan gambar tersebut
        $imagePath = $request->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pengembalian-images');
        }

        $pengembalian->update([
            'user_id' => $request->namaPengembali,
            'aset_id' => $peminjaman->aset_id,
            'nama_aset_id' => $peminjaman->nama_aset_id,
            'kodePengembalian' => $peminjaman->kodePeminjaman,
            'tglPengembalian' => $request->tglPengembalian,
            'status' => $status,
            'lokasi_id' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'image' => $imagePath
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

    public function deleteuser($id){
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()->route('pengembalian.history.user');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        $pengembalian->delete();

        if ($pengembalian->image) {
            Storage::delete($pengembalian->image);
        }

        return redirect()->route('pengembalian.history');
    }
}

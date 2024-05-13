<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Lokasi;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.setting.index', [
            'title' => 'setting',
        ]);
    }

    public function indexdivisi(){
        $divisi = Divisi::all();

        return view('dashboard.setting.divisi.index', compact('divisi'), [
            'title' => 'Divisi',
        ]);
    }
    public function indexlokasi(){
        $lokasi = Lokasi::all();

        return view('dashboard.setting.lokasi.index', compact('lokasi'), [
            'title' => 'Lokasi',
        ]);
    }

    public function indexnotification(){
        $notification = Notification::all();

        return view('dashboard.setting.notification.index', compact('notification'), [
            'title' => 'Notification',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createdivisi()
    {
        return view('dashboard.setting.divisi.divisicreate', [
            'title' => 'Create Divisi'
        ]);
    }

    public function createlokasi(){
        return view('dashboard.setting.lokasi.lokasicreate', [
            'title' => 'Create lokasi'
        ]);
    }

    public function createnotification(){

        $admin = User::whereIn('role', ['admin', 'adminsuper'])->get();

        return view('dashboard.setting.notification.notificationcreate', compact('admin'), [
            'title' => 'Create Notification'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storedivisi(Request $request)
    {
        $request->validate([
            'kodeDivisi' => 'required|unique:divisi,kodeDivisi',
            'namaDivisi' => 'required|unique:divisi,namaDivisi',
        ],[
            'kodeDivisi.required' => 'Kolom kode divisi wajib diisi.',
            'kodeDivisi.unique' => 'Kode divisi sudah digunakan.',
            'namaDivisi.required' => 'Kolom nama divisi wajib diisi.',
            'namaDivisi.unique' => 'Nama divisi sudah digunakan.',
        ]);

        $divisi = Divisi::create([
            'kodeDivisi' => $request->kodeDivisi,
            'namaDivisi' => $request->namaDivisi
        ]);

        // Jika validasi berhasil, lanjutkan dengan menyimpan data
    

        return redirect(route('setting.index.divisi'));
    }

    public function storelokasi(Request $request){
        $request->validate([
            'kodeLokasi' => 'required|unique:lokasi,kodeLokasi',
            'alamat' => 'required|unique:lokasi,alamat',
        ],[
            'kodeLokasi.required' => 'Kolom kode lokasi wajib diisi.',
            'kodeLokasi.unique' => 'Kode lokasi sudah digunakan.',
            'alamat.required' => 'Kolom alamat wajib diisi.',
            'alamat.unique' => 'Alamat sudah digunakan.',
        ]);

        $lokasi = Lokasi::create([
            'kodeLokasi' => $request->kodeLokasi,
            'alamat' => $request->alamat
        ]);

        return redirect(route('setting.index.lokasi'));
    }

    public function storenotification(Request $request){
        $user = User::findOrFail($request->nama);
        
        $notification = Notification::create([
            'name' => $user->name,
            'email' => $user->email
        ]);

        return redirect(route('setting.index.notification'));
    }
    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function editdivisi($id)
    {
        $divisi = Divisi::findOrFail($id);

        return view('dashboard.setting.divisi.divisiedit', compact('divisi'), [
            'title' => 'Edit Divisi'
        ]);
    }

    public function editlokasi($id){
        $lokasi = Lokasi::findOrFail($id);

        return view('dashboard.setting.lokasi.lokasiedit', compact('lokasi'), [
            'title' => 'Edit Lokasi'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatedivisi(Request $request, $id)
    {
        $divisi = Divisi::findOrFail($id);

        $request->validate([
            'kodeDivisi' => 'required|unique:divisi,kodeDivisi,' . $id,
            'namaDivisi' => 'required|unique:divisi,namaDivisi,' . $id,
        ],[
            'kodeDivisi.required' => 'Kolom kode divisi wajib diisi.',
            'kodeDivisi.unique' => 'Kode divisi sudah digunakan.',
            'namaDivisi.required' => 'Kolom nama divisi wajib diisi.',
            'namaDivisi.unique' => 'Nama divisi sudah digunakan.',
        ]);

        $divisi->update([
            'kodeDivisi' => $request->kodeDivisi,
            'namaDivisi' => $request->namaDivisi
        ]);

        return redirect(route('setting.index.divisi'));
    }

    public function updatelokasi($id, Request $request){
        $lokasi = Lokasi::findOrFail($id);

        $request->validate([
            'kodeLokasi' => 'required|unique:lokasi,kodeLokasi,' . $id,
            'alamat' => 'required|unique:lokasi,alamat,' . $id,
        ],[
            'kodeLokasi.required' => 'Kolom kode lokasi wajib diisi.',
            'kodeLokasi.unique' => 'Kode lokasi sudah digunakan.',
            'alamat.required' => 'Kolom alamat wajib diisi.',
            'alamat.unique' => 'Alamat sudah digunakan.',
        ]);

        $lokasi->update([
            'kodeLokasi' => $request->kodeLokasi,
            'alamat' => $request->alamat
        ]);

        return redirect(route('setting.index.lokasi'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletedivisi($id)
    {
        $divisi = Divisi::findOrFail($id);

        $divisi->delete();

        return redirect(route('setting.index.divisi'));
    }

    public function deletelokasi($id){
        $lokasi = Lokasi::findOrFail($id);

        $lokasi->delete();

        return redirect(route('setting.index.lokasi'));
    }

    public function deletenotification($id){
        $notification = Notification::findOrFail($id);

        $notification->delete();

        return redirect(route('setting.index.notification'));
    }
}

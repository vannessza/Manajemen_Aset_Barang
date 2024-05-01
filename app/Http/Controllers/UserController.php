<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Mengambil hanya pengguna dengan peran 'user'
        $user = User::where('role', 'user')->get();

        return view('dashboard.akun.user.index', compact('user'), [
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

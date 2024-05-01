@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10">
    <div class="bg-white w-auto rounded-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="m-4">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-900">Detail Peminjaman</h1>
                <h1 class="text-lg font-semibold text-gray-900">{{ $peminjaman->kodePeminjaman ? $peminjaman->kodePeminjaman : 'XXXX/XXX/XXX/XX' }}</h1>
            </div>
            <hr class="border-1 border-black mt-2">
            <div class="flex mt-2">
                <div class="w-24 h-24">
                    <img src="{{ asset('image/icon/User.png') }}" alt="">
                </div>
                <div class="my-auto ml-4">
                    <p class="font-semibold">{{ $peminjaman->user->name }}</p>
                    <p class="text-xs">{{ $peminjaman->user->profile->divisi->namaDivisi }}</p>
                </div>
            </div>
            <div class="mt-2 flex">
                <p class="w-60">Nama Aset</p>
                <p class="whitespace-nowrap text-base text-gray-800">{{ $peminjaman->AsetDetail->namaAset}}</p>
            </div>
            <div class="mt-2 flex">
                <p class="w-60">Aset</p>
                <p class="text-sm">{{ $peminjaman->aset->namaAset}}</p>
            </div>
            <div class="mt-2 flex">
                <p class="w-60">Tanggal Peminjaman</p>
                <p class="text-sm">{{ $peminjaman->tglPeminjaman}}</p>
            </div>
            <div class="mt-2 flex">
                <p class="w-60">Status</p>
                <p class="text-sm  @if ($peminjaman->status === 'Diterima')
                    text-green-600 font-semibold
                @elseif($peminjaman->status === 'Diproses')
                    text-yellow-600 font-semibold
                @elseif($peminjaman->status === 'Ditolak')
                    text-red-600 font-semibold
                @endif">{{ $peminjaman->status}}</p>
            </div>
            <div class="mt-4">
                <h1 class="font-semibold text-gray-900">Keterangan</h1>
                <p class="text-sm">{{ $peminjaman->keterangan }}</p>
            </div>
        </div>
    </div>
</div>

@endsection
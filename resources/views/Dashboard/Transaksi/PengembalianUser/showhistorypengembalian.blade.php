@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-36 mb-10">
    <div class="bg-white max-w-4xl m-auto w-auto rounded-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="mx-4">
            <div class="flex justify-between">
                <div class="flex">
                    <a href="{{ route('pengembalian.history.user') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
                    </a>
                    <h1 class="lg:text-lg font-semibold text-gray-900 ml-4">Detail Pengembalian</h1>
                </div>
                <h1 class="lg:text-lg font-semibold text-gray-900">{{ $pengembalian->kodePengembalian ? $pengembalian->kodePengembalian : 'XXXX/XXX/XXX/XX' }}</h1>
            </div>
            <hr class="border-1 border-black mt-2">
            <div class="mt-5">
            <div class="items-center mb-8 lg:block text-center">
                <div class="">
                    @if ($pengembalian->user->profile->image)
                        <img src="{{ asset('storage/'. $pengembalian->user->profile->image) }}" alt="User Image" class="inline-block h-20 w-20 rounded-full">
                    @else
                        <img src="{{ asset('image/icon/User.png') }}" alt="Default Image" class="inline-block h-20 w-20 rounded-full">
                    @endif
                </div>
                <div class="mt-2">
                    <span class="py-1.5 px-2 text-sm font-medium bg-teal-100 text-teal-800 rounded-lg">
                        {{ $pengembalian->user->role }}
                    </span>
                    <h2 class="text-lg font-semibold leading-none text-gray-900 md:text-xl">{{ $pengembalian->user->name }} 
                    </h2>
                    <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400 text-sm">{{ $pengembalian->user->profile->divisi->namaDivisi }}</p>
                </div>
            </div>
            <div class="">
                <div class="mt-2 flex">
                    <p class="w-60">Nama Aset</p>
                    <p class="whitespace-nowrap text-base text-gray-800">{{ $pengembalian->AsetDetail->namaAset}}</p>
                </div>
                <div class="mt-2 flex">
                    <p class="w-60">Aset</p>
                    <p class="text-sm">{{ $pengembalian->aset->namaAset}}</p>
                </div>
                <div class="mt-2 flex">
                    <p class="w-60">Tanggal Pengembalian</p>
                    <p class="text-sm">{{ $pengembalian->tglPengembalian}}</p>
                </div>
                <div class="mt-2 flex">
                    <p class="w-60">Status</p>
                    <p class="text-sm  @if ($pengembalian->status === 'Diterima')
                        text-green-600 font-semibold
                    @elseif($pengembalian->status === 'Diproses')
                        text-yellow-600 font-semibold
                    @elseif($pengembalian->status === 'Ditolak')
                        text-red-600 font-semibold
                    @endif">{{ $pengembalian->status}}</p>
                </div>
                <div class="mt-4">
                    <h1 class="font-semibold text-gray-900">Keterangan</h1>
                    <p class="text-sm">{{ $pengembalian->keterangan }}</p>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
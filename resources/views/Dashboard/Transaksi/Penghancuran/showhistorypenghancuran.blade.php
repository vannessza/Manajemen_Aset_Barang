@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10">
    <div class="bg-white w-auto rounded-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="m-4">
            <div class="flex">
                <a href="{{ route('penghancuran.history') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
                    </a>
                <h1 class="text-lg font-semibold text-gray-900 ml-2">Detail Penghancuran</h1>
            </div>
            <hr class="border-1 border-black mt-2">
            <div class="mt-2 flex">
                <p class="w-60">Nama Aset</p>
                <p class="whitespace-nowrap text-base text-gray-800">{{ $penghancuran->nama_aset}}</p>
            </div>
            <div class="mt-2 flex">
                <p class="w-60">Aset</p>
                <p class="text-sm">{{ $penghancuran->aset->namaAset }}</p>
            </div>
            <div class="mt-2 flex">
                <p class="w-60">Tanggal Pemusnahan</p>
                <p class="text-sm">{{ $penghancuran->tglPemusnahan }}</p>
            </div>
            <div class="mt-2 flex">
                <p class="w-60">Pemohon</p>
                <p class="text-sm">{{ $penghancuran->userpemohon->name }}</p>
            </div>
            @if($penghancuran->status === 'Disetujui')
                <div class="mt-2 flex">
                    <p class="w-60">Penerima</p>
                    <p class="text-sm">{{ $penghancuran->userpengesahan->name }}</p>
                </div>
            @endif
            <div class="mt-2 flex">
                <p class="w-60">Status</p>
                <p class="text-sm  @if ($penghancuran->status === 'Disetujui')
                    text-green-600 font-semibold
                @elseif($penghancuran->status === 'Diproses')
                    text-yellow-600 font-semibold
                @elseif($penghancuran->status === 'Ditolak')
                    text-red-600 font-semibold
                @endif">{{ $penghancuran->status}}</p>
            </div>
            <div class="mt-2 flex">
                <p class="w-60">Download Bukti Formulir</p>
                <a href="{{ route('penghancuran.export.bukti', $penghancuran->id) }}" class="bg-[#008d8d] hover:bg-[#006c6c] text-white font-bold py-1 px-2 rounded text-sm">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                      </svg>                                                           
                </a>
            </div>
            <div class="mt-4">
                <h1 class="font-semibold text-gray-900">Keterangan</h1>
                <p class="text-sm">{{ $penghancuran->keterangan }}</p>
            </div>
        </div>
    </div>
</div>

@endsection
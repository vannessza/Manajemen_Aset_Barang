@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10">
    <div class="bg-white w-auto rounded-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="m-4">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-900">Detail Penghancuran</h1>
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
                <p class="text-sm">{{ $penghancuran->pemohon }}</p>
            </div>
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
                <p class="w-60">Formulir</p>
                <a href="" class="bg-[#008d8d] hover:bg-[#006c6c] text-white font-bold py-1 px-2 rounded">
                    Download Formulir
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
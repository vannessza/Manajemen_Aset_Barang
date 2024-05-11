@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-36 mb-10">
    <div class="bg-white max-w-4xl m-auto w-auto rounded-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="mx-4">
            <div class="flex justify-between">
                <div class="flex">
                    <a href="{{ route('pengembalian.history') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
                    </a>
                    <h1 class="lg:text-lg font-semibold text-gray-900 ml-4">Detail Pengembalian</h1>
                </div>
                <h1 class="lg:text-lg font-semibold text-gray-900">{{ $pengembalian->kodePeminjaman ? $pengembalian->kodePeminjaman : 'XXXX/XXX/XXX/XX' }}</h1>
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
                    <p class="text-sm  @if ($pengembalian->status === 'Dikembalikan')
                        text-green-600 font-semibold
                    @elseif($pengembalian->status === 'Diproses')
                        text-yellow-600 font-semibold
                    @elseif($pengembalian->status === 'Ditolak')
                        text-red-600 font-semibold
                    @endif">{{ $pengembalian->status}}</p>
                </div>
                @if ($pengembalian->status === 'Dikembalikan')
                <div class="mt-2 flex">
                    <p class="w-60">Download Bukti Formulir</p>
                    <a href="{{ route('pengembalian.export.bukti', $pengembalian->id) }}" class="bg-[#008d8d] hover:bg-[#006c6c] text-white font-bold py-1 px-2 rounded text-sm">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                          </svg>                                                           
                    </a>
                </div>
                @elseif ($pengembalian->status === 'Diproses')
                    <div class="mt-2 flex">
                        <p class="w-60">Formulir Pengembalian</p>
                        <a href="{{ route('pengembalian.show.exportformulir', $pengembalian->id) }}" class="bg-[#008d8d] hover:bg-[#006c6c] text-white font-bold py-1 px-2 rounded text-sm">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                              </svg>                                                           
                        </a>
                    </div>
                @endif
                    
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
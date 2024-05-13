@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-36 mb-10">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl py-5 px-8 m-auto">
        <div class="flex p-6">
            <a href="{{ route('detailaset.index', $aset->id) }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="text-lg font-semibold text-gray-900">Edit Aset</h1>
            </div>
            
        </div>
        <div class="mx-auto block max-w-xl rounded-lg bg-white p-6 shadow-4">
            <form action="{{ route('detailaset.update', ['aset' => $aset->id, 'asetDetail' => $asetDetail->id] ) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="namaAset" class="block mb-2 text-sm font-medium text-gray-90">Nama Aset</label>
                        <input type="text" name="namaAset" id="namaAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan nama aset register" required value="{{ $asetDetail->namaAset }}">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="detailAset" class="block mb-2 text-sm font-medium text-gray-900">Detail Aset</label>
                        <textarea id="detailAset" name="detailAset" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 " placeholder="Tuliskan detail aset register" value="{{ $asetDetail->detailAset }}">{{ $asetDetail->detailAset }}</textarea>                    
                    </div>
                    <div class="sm:col-span-2">
                        <label for="jenisAset" class="block mb-2 text-sm font-medium text-gray-90">Jenis Aset register</label>
                        <input type="text" name="jenisAset" id="jenisAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan jenis aset register" required value="{{ $asetDetail->jenisAset }}">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="klasifikasiAset" class="block mb-2 text-sm font-medium text-gray-900">Klasifikasi Aset</label>
                        <select id="klasifikasiAset" name="klasifikasiAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Klasifikasi</option>
                            <option value="Terbatas" {{ $asetDetail->klasifikasiAset === 'Terbatas' ? 'selected' : '' }}>Terbatas</option>
                            <option value="Rahasia" {{ $asetDetail->klasifikasiAset === 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                            <option value="Internal" {{ $asetDetail->klasifikasiAset === 'Internal' ? 'selected' : '' }}>Internal</option>
                            <option value="Public" {{ $asetDetail->klasifikasiAset === 'Public' ? 'selected' : '' }}>Public</option>
                        </select>
                    </div>
                    <div class="" data-hs-input-number="">
                        <label for="masaRetensi" class="block mb-2 text-sm font-medium text-gray-900">Masa Retensi</label>
                        <div class="w-full flex justify-between items-center gap-x-5">
                            <div class="grow">
                                <input id="masaRetensi" name="masaRetensi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" type="text" required value="{{ $asetDetail->masaRetensi }}">
                            </div>
                            <div class="flex justify-end items-center gap-x-1.5">
                                <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-input-number-decrement="" onclick="decrementMasaRetensi()">
                                    <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                    </svg>
                                </button>
                                <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-input-number-increment="" onclick="incrementMasaRetensi()">
                                    <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5v14"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>                    
                    <div class="" data-hs-input-number="">
                        <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900">Jumlah</label>
                        <div class="w-full flex justify-between items-center gap-x-5">
                            <div class="grow">
                                <input id="jumlah" name="jumlah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" type="text" required value="{{ $asetDetail->jumlah }}">
                            </div>
                            <div class="flex justify-end items-center gap-x-1.5">
                                <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-input-number-decrement="" onclick="decrementJumlah()">
                                    <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                    </svg>
                                </button>
                                <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-input-number-increment="" onclick="incrementJumlah()">
                                    <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5v14"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>                                                                          
                    <div class="sm:col-span-2">
                        <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Pembelian</label>
                        <input type="date" id="tanggal" name="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Tanggal pembelian" required>
                    </div>

                </div>
                <button type="submit" class="inline-block w-full rounded bg-[#B8BC00] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong" data-twe-ripple-init data-twe-ripple-color="light">
                    Edit
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
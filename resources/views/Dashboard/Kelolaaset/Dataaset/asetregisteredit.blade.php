@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10">
    <div class="bg-white rounded-xl shadow-xl py-5 px-8 w-3/4 m-auto">
        <div class="flex">
            <a href="{{ route('dataaset.update', $aset->id) }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="font-bold text-xl text-center">Edit Aset Register</h1>
            </div>
            
        </div>
        <div class="mx-auto block max-w-md rounded-lg bg-white p-6 shadow-4 dark:bg-surface-dark">
            <form method="POST" action="{{ route('dataaset.update', $aset->id ) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="max-w-lg my-10">
                    <label for="namaAset" class="block text-sm font-medium mb-2">Aset</label>
                    <input type="text" id="namaAset" name="namaAset" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:ring-2" placeholder="Jenis Aset" value="{{ $aset->namaAset }}" required>
                </div>
                <div class="max-w-lg mt-10">
                    <label for="detailAset" class="block text-sm font-medium mb-2">Detail Aset</label>
                    <textarea id="detailAset" name="detailAset" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Detail Aset" required>{{ $aset->detailAset }}</textarea>
                </div>
                <div class="max-w-lg my-10">
                    <label for="jenisAset" class="block text-sm font-medium mb-2">Jenis Aset</label>
                    <input type="text" id="jenisAset" name="jenisAset" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:ring-2" placeholder="Jenis Aset" value="{{ $aset->jenisAset }}" required>
                </div>
                <div class="max-w-lg my-10">
                    <label for="select-label" class="block text-sm font-medium mb-2">Klasfikasi Aset</label>
                    <select id="klasifikasiAset" name="klasifikasiAset" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ $aset->klasifikasiAset }}" required>
                        <option>Pilih Klasifikasi</option>
                        <option value="Terbatas" >Terbatas</option>
                        <option value="Rahasia" >Rahasia</option>
                        <option value="Internal" >Internal</option>
                        <option value="Publik" >Publik</option>
                    </select>
                </div>
                <div class="max-w-lg my-10">
                    <label for="select-label" class="block text-sm font-medium mb-2">CIA Level</label>
                    <select id="ciaLevel" name="ciaLevel" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ $aset->ciaLevel }}" required>
                        <option>Pilih CIA Level</option>
                        <option value="Terbatas" >Low</option>
                        <option value="Rahasia" >High</option>
                        <option value="Internal" >Medium</option>
                    </select>
                </div>
                <div class="py-2 bg-gray-100 rounded-lg my-10">
                    <label for="nilaiRisiko" class="block text-sm font-medium mb-2">Nilai Risiko</label>
                    <div class="w-full flex justify-between items-center gap-x-5">
                        <div class="grow">
                            <input id="nilaiRisiko" name="nilaiRisiko" class="w-full p-0 bg-transparent border-0 text-gray-800 focus:ring-0" type="text" value="{{ $aset->nilaiRisiko }}" required>
                        </div>
                        <div class="flex justify-end items-center gap-x-1.5">
                            <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" onclick="decrementNilaiRisiko()">
                                <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                </svg>
                            </button>
                            <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" onclick="incrementNilaiRisiko()">
                                <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5v14"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="py-2 bg-gray-100 rounded-lg my-10">
                    <label for="masaRetensi" class="block text-sm font-medium mb-2">Masa Retensi</label>
                    <div class="w-full flex justify-between items-center gap-x-5">
                        <div class="grow">
                            <input id="masaRetensi" name="masaRetensi" class="w-full p-0 bg-transparent border-0 text-gray-800 focus:ring-0" type="text" value="{{ $aset->masaRetensi }}" required>
                        </div>
                        <div class="flex justify-end items-center gap-x-1.5">
                            <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" onclick="decrementMasaRetensi()">
                                <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                </svg>
                            </button>
                            <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" onclick="incrementMasaRetensi()">
                                <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5v14"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="inline-block w-full rounded bg-[#B8BC00] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong" data-twe-ripple-init data-twe-ripple-color="light">
                    Create
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
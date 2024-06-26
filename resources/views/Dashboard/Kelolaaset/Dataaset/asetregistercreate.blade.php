@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-36 mb-10">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl py-5 px-8 m-auto">
        <div class="flex p-6">
            <a href="{{ route('dataaset.index') }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="text-lg font-semibold text-gray-900">Aset Register</h1>
            </div>
            
        </div>
        <div class="mx-auto block max-w-xl rounded-lg bg-white p-6 shadow-4">
            <form action="{{ route('dataaset.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="aset" class="block mb-2 text-sm font-medium text-gray-90">Aset</label>
                        <input type="text" name="aset" id="aset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan nama aset register" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="jenisAset" class="block mb-2 text-sm font-medium text-gray-90">Jenis Aset register</label>
                        <input type="text" name="jenisAset" id="jenisAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan jenis aset register" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="klasifikasiAset" class="block mb-2 text-sm font-medium text-gray-900">Klasifikasi Aset</label>
                        <select id="klasifikasiAset" name="klasifikasiAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Klasifikasi</option>
                            <option value="Terbatas" >Terbatas</option>
                            <option value="Rahasia" >Rahasia</option>
                            <option value="Internal" >Internal</option>
                            <option value="Publik" >Publik</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="ciaLevel" class="block mb-2 text-sm font-medium text-gray-900">CIA Level</label>
                        <select id="ciaLevel" name="ciaLevel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih CIA Level</option>
                            <option value="Low" >Low</option>
                            <option value="Medium" >Medium</option>
                            <option value="High" >High</option>
                        </select>
                    </div>
                    <div class="" data-hs-input-number="">
                        <label for="nilaiRisiko" class="block mb-2 text-sm font-medium text-gray-900">Nilai Risiko</label>
                        <div class="w-full flex justify-between items-center gap-x-5">
                            <div class="grow">
                                <input id="nilaiRisiko" name="nilaiRisiko" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" type="text" value="1" required>
                            </div>
                            <div class="flex justify-end items-center gap-x-1.5">
                                <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-input-number-decrement="" onclick="decrementNilaiRisiko()">
                                    <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                    </svg>
                                </button>
                                <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-input-number-increment="" onclick="incrementNilaiRisiko()">
                                    <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5v14"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>                    
                    <div class="" data-hs-input-number="">
                        <label for="masaRetensi" class="block mb-2 text-sm font-medium text-gray-900">Masa Retensi</label>
                        <div class="w-full flex justify-between items-center gap-x-5">
                            <div class="grow">
                                <input id="masaRetensi" name="masaRetensi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" type="text" value="1" required>
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
                    <div class="sm:col-span-2">
                        <label for="detailAset" class="block mb-2 text-sm font-medium text-gray-900">Detail Aset</label>
                        <textarea id="detailAset" name="detailAset" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 " placeholder="Tuliskan detail aset register"></textarea>                    
                    </div>

                </div>
                <button type="submit" class="inline-block w-full rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong" data-twe-ripple-init data-twe-ripple-color="light">
                    Create
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

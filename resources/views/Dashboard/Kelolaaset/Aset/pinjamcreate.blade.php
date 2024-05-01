@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl py-5 px-8 m-auto">
        <div class="flex p-6">
            <a href="{{ route('aset.show', $asetDetail->id) }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="text-xl font-semibold text-gray-900 ">Peminjaman</h1>
            </div>
            
        </div>
        
        <div class="mx-auto block max-w-xl rounded-lg bg-white p-6 shadow-4">
            <form action="{{ route('aset.store', $asetDetail->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <h1 class="text-lg font-semibold text-gray-900">Informasi Aset</h1>
                </div>
                <div class="mt-6 mb-6">
                    <div class="flex">
                        <p class="text-base font-medium text-gray-900 w-1/3">Nama</p>
                        <p class="text-base font-normal text-gray-500">{{ $asetDetail->namaAset }}</p>
                    </div>
                    <div class="flex mt-4">
                        <p class="text-base font-medium text-gray-900 w-1/3">Aset</p>
                        <p class="text-base font-normal text-gray-500">{{ $asetDetail->aset->namaAset }}</p>
                    </div>
                    <div class="flex mt-4">
                        <p class="text-base font-medium text-gray-900 w-1/3">Jenis Aset</p>
                        <p class="text-base font-normal text-gray-500">{{ $asetDetail->jenisAset}}</p>
                    </div>
                    <div class="flex mt-4">
                        <p class="text-base font-medium text-gray-900 w-1/3">Masa Retensi</p>
                        <p class="text-base font-normal text-gray-500">{{ $asetDetail->masaRetensi}} Tahun</p>
                    </div>
                    <div class="flex mt-4">
                        <p class="text-base font-medium text-gray-900 w-1/3">Tanggal Pembelian</p>
                        <p class="text-base font-normal text-gray-500">{{ $asetDetail->tglPembelian }}</p>
                    </div>
                    <div class="flex mt-4">
                        <p class="text-base font-medium text-gray-900 w-1/3">Jumlah</p>
                        <p class="text-base font-normal text-gray-500">{{ $asetDetail->jumlah }}</p>
                    </div>
                </div>
                <div>
                    <h1 class="text-lg font-semibold text-gray-900">Detail Aset</h1>
                </div>
                <div class="mt-6 mb-6">
                    <p class="text-base font-normal text-gray-500">{{ $asetDetail->detailAset }}</p>
                </div>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="tglPeminjaman" class="block mb-2 text-lg font-semibold text-gray-900">Tanggal Peminjaman</label>
                        <input type="date" name="tglPeminjaman" id="tglPeminjaman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Product brand" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="lokasi" class="block mb-2 text-lg font-semibold text-gray-900">Lokasi Peminjaman</label>
                        <select id="lokasi" name="lokasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Lokasi</option>
                            @foreach ($lokasi as $lo)
                                <option value="{{ $lo->id }}">{{ $lo->alamat }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <button type="submit" class="inline-block w-full rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong" data-twe-ripple-init data-twe-ripple-color="light">
                    Pinjam
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
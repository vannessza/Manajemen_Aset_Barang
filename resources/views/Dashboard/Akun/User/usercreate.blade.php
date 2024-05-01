@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-36 mb-10">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl py-5 px-8 m-auto">
        <div class="flex p-6">
            <a href="{{ route('dataaset.index') }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="text-lg font-semibold text-gray-900">User</h1>
            </div>
            
        </div>
        <div class="mx-auto block max-w-xl rounded-lg bg-white p-6 shadow-4">
            <form action="{{ route('dataaset.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="aset" class="block mb-2 text-sm font-medium text-gray-90">Nama</label>
                        <input type="text" name="aset" id="aset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan nama aset register" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="jenisAset" class="block mb-2 text-sm font-medium text-gray-90">Email</label>
                        <input type="email" name="jenisAset" id="jenisAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan jenis aset register" required="">
                    </div>
                    <div class="">
                        <label for="jenisAset" class="block mb-2 text-sm font-medium text-gray-90">Password</label>
                        <input type="password" name="jenisAset" id="jenisAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan jenis aset register" required="">
                    </div>
                    <div class="">
                        <label for="jenisAset" class="block mb-2 text-sm font-medium text-gray-90">Konfirmasi Password</label>
                        <input type="password" name="jenisAset" id="jenisAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan jenis aset register" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="klasifikasiAset" class="block mb-2 text-sm font-medium text-gray-900">Klasifikasi Aset</label>
                        <select id="klasifikasiAset" name="klasifikasiAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Divisi</option>
                            @foreach ($divisi as $di)
                                <option value="{{ $di->id }}">{{ $di->namaDivisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="aset" class="block mb-2 text-sm font-medium text-gray-90">Alamat</label>
                        <input type="text" name="aset" id="aset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan nama aset register" required="">
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

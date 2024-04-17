@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10">
    <div class="bg-white w-1/2 rounded-xl shadow-xl py-5 px-4 m-auto">
        <div>
            <div class="flex">
                <a href="{{ route('dataaset.index') }}">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
                </a>
               
                <div class="m-auto">
                    <h1 class="font-bold text-xl text-center">Aset Register</h1>
                </div>
                
            </div>
            <div class="mt-10">
                <form action="{{ route('dataaset.store') }}" method="POST" class="w-full">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="name">
                            Aset:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="aset" type="text" placeholder="Masukkan nama aset register" name="aset">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="email">
                            Detail:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenis_aset" type="text" placeholder="Masukkan jenis aset" name="jenis_aset">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="phone">
                            Klasifikasi Aset:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="klasifikasi_aset" type="text" placeholder="Masukkan klasifikasi aset" name="klasifikasi_aset">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="phone">
                            CIA Level:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cia_level" type="text" placeholder="Masukkan CIA level" name="cia_level">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="phone">
                            Nilai Risiko:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nilai_risiko" type="text" placeholder="Masukkan nilai risiko" name="nilai_risiko">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="phone">
                            Masa Retensi:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="masa_retensi" type="text" placeholder="Masukkan masa retensi" name="masa_retensi">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2" for="message">
                            Detail Aset:
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="detailAset" placeholder="Masukkan pesan" name="detailAset"></textarea>
                    </div>
                    <div class="flex flex-col items-center">
                        <button class="bg-[#00C74F] hover:bg-[#00963C] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
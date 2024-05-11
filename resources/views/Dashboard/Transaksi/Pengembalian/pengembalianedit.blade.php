@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl py-5 px-8 m-auto">
        <div class="flex p-6">
            <a href="{{ route('pengembalian.index') }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="text-lg font-semibold text-gray-900">Pengembalian</h1>
            </div>
            
        </div>
        <div class="mx-auto block max-w-xl rounded-lg bg-white p-6 shadow-4">
            <form id="pengembalianForm" action="{{ route('pengembalian.update', $pengembalian->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="select-label" class="block mb-2 text-sm font-medium text-gray-900">Nama Pengembali</label>
                        <select id="select-label" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" name="namaPengembali">
                            <option value="">Pilih Nama Pengembali</option>
                            @foreach ($uniqueUsers as $pe)
                                <option value="{{ $pe->user->id }}" {{ $pe->user->id == $pengembalian->user_id ? 'selected' : '' }}>{{ $pe->user->name }}</option>
                            @endforeach
                        </select>                
                    </div>                                        
                    <div class="sm:col-span-2">
                        <label for="namaAset" class="block text-sm font-medium mb-2">Nama Aset</label>
                        <select id="namaAset" name="namaAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Nama Aset yang dikembalikan</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="tglPengembalian" class="block mb-2 text-sm font-medium text-gray-90">Tanggal Pengembalian</label>
                        <input type="date" name="tglPengembalian" id="tglPengembalian" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Product brand" required="" value="{{ $pengembalian->tglPengembalian }}">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900">Lokasi Pengembalian</label>
                        <select id="lokasi" name="lokasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Lokasi</option>
                            @foreach ($lokasi as $lo)
                                <option value="{{ $lo->id }}" {{ $lo->id == $pengembalian->lokasi_id ? 'selected' : '' }}>{{ $lo->alamat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 " placeholder="Tulis Keterangan di sini..." value="{{ $pengembalian->keterangan }}">{{ $pengembalian->keterangan }}</textarea>                    
                    </div>
                    
                    <div class="max-w-sm">
                        <label class="block">
                            <input type="hidden" name="oldImage" value="{{ $pengembalian->image }}">
                            <span class="sr-only">Choose profile photo</span>
                            <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500
                                file:me-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-600 file:text-white
                                hover:file:bg-blue-700
                                file:disabled:opacity-50 file:disabled:pointer-events-none
                                dark:text-neutral-500
                                dark:file:bg-blue-500
                                dark:hover:file:bg-blue-400
                            " onchange ="previewImage()">
                        </label>
                    </div>

                </div>
                <button type="submit" class="inline-block w-full rounded bg-[#B8BC00] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong" data-twe-ripple-init data-twe-ripple-color="light">
                    Edit
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectedUserId = document.getElementById('select-label').value;
        var namaAsetDropdown = document.getElementById('namaAset');

        // Memanggil fungsi untuk menampilkan opsi nama aset berdasarkan pengembali yang dipilih
        updateAsetOptions(selectedUserId);

        // Event listener untuk perubahan dropdown nama pengembali
        document.getElementById('select-label').addEventListener('change', function() {
            var selectedUserId = this.value;

            // Memanggil fungsi untuk menampilkan opsi nama aset berdasarkan pengembali yang dipilih
            updateAsetOptions(selectedUserId);
        });

        // Fungsi untuk menampilkan opsi nama aset berdasarkan pengembali yang dipilih
        function updateAsetOptions(selectedUserId) {
            namaAsetDropdown.innerHTML = '';

            // Menambahkan opsi default
            var defaultOption = document.createElement('option');
            defaultOption.text = 'Pilih Nama Aset yang dikembalikan';
            namaAsetDropdown.add(defaultOption);

            @foreach ($peminjaman->where('status', 'Diterima')->where('user_id', $pengembalian->user_id) as $pe)
                var option = document.createElement('option');
                option.value = "{{ $pe->asetDetail->id }}"; // Ganti 'nama' dengan kolom yang menyimpan id aset
                option.text = "{{ $pe->asetDetail->namaAset }}";
                @if ($pe->kodePeminjaman == $pengembalian->kodePengembalian)
                    option.selected = true; // Pilih opsi jika kode peminjaman sama dengan kode pengembalian
                @endif
                namaAsetDropdown.add(option);
            @endforeach
        }
    });
</script>


@endsection

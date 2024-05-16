@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 m-auto">
        <div class="flex p-6">
            <a href="{{ route('user.show.daftaraset', $user->id) }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="text-lg font-semibold text-gray-900">Tambah Aset</h1>
            </div>
            
        </div>
        <div class="mx-auto block max-w-xl rounded-lg bg-white p-6 shadow-4">
            <form action="{{ route('user.show.tambahaset.store', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="">
                        <label for="aset" class="block mb-2 text-sm font-medium text-gray-900">Aset</label>
                        <select id="aset" name="aset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Aset</option>
                            @foreach ($aset as $as)
                                <option value="{{ $as->id }}">{{ $as->namaAset }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="namaAset" class="block text-sm font-medium mb-2">Nama Aset</label>
                        <select id="namaAset" name="namaAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Nama Aset</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="tglPeminjaman" class="block mb-2 text-sm font-medium text-gray-90">Tanggal Peminjaman</label>
                        <input type="date" name="tglPeminjaman" id="tglPeminjaman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Product brand" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900">Lokasi Peminjaman</label>
                        <select id="lokasi" name="lokasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Lokasi</option>
                            @foreach ($lokasi as $lo)
                                <option value="{{ $lo->id }}">{{ $lo->alamat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 " placeholder="Tulis Keterangan di sini..."></textarea>                    
                    </div>
                    
                    <div class="max-w-sm mb-2">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Upload Formulir</label>
                        <label class="block">
                            <span class="sr-only">Choose file</span>
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
                            " onchange="previewImage()">
                        </label>
                    </div>

                </div>
                <button type="submit" class="inline-block w-full rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong" data-twe-ripple-init data-twe-ripple-color="light">
                    Create
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('aset').addEventListener('change', function() {
        var selectedAsetId = this.value;
        var namaAsetDropdown = document.getElementById('namaAset');
        
        // Menghapus semua opsi saat ini
        namaAsetDropdown.innerHTML = '';
        
        // Menambahkan opsi default
        var defaultOption = document.createElement('option');
        defaultOption.text = 'Pilih Nama Aset';
        namaAsetDropdown.add(defaultOption);
        
        // Filter dan tambahkan opsi yang sesuai
        @foreach ($aset as $as)
            if ({{ $as->id }} == selectedAsetId) {
                @foreach ($as->asetDetail()->where('status', 'Tersedia')->get() as $detail)
                    var option = document.createElement('option');
                    option.value = "{{ $detail->id }}";
                    option.text = "{{ $detail->namaAset }}";
                    namaAsetDropdown.add(option);
                @endforeach
            }
        @endforeach
    });
</script>
@endsection
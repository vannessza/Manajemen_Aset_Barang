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
            <form action="{{ route('pengembalian.edit', $pengembalian->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="select-label" class="block mb-2 text-sm font-medium text-gray-900">Nama Pengembali</label>
                        <select id="select-label" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" name="namaPengembali" data-hs-select='{
                            "placeholder": "Select assignee",
                            "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800\" data-title></span></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1]",
                            "dropdownClasses": "mt-2 max-h-72 p-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                            "optionClasses": "py-2 px-3 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100",
                            "optionTemplate": "<div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div><div class=\"hs-selected:font-semibold text-sm text-gray-800\" data-title></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"flex-shrink-0 size-4 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"flex-shrink-0 size-3.5 text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                        }'>
                            <option value="">Pilih Nama Pengembali</option>
                            @php
                                $uniqueUsers = $peminjaman->unique('user_id'); // Filter nama pengembali yang unik
                            @endphp
                            @foreach ($uniqueUsers as $pe)
                                <option value="{{ $pe->user->id }}" {{ $pengembalian->user_id == $pe->user->id ? 'selected' : '' }}>{{ $pe->user->name }}</option>
                            @endforeach
                        </select>                    
                    </div>
                    <div class="">
                        <label for="aset" class="block mb-2 text-sm font-medium text-gray-900">Aset</label>
                        <select id="aset" name="aset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Aset</option>
                            @if ($pengembalian->aset) <!-- Periksa apakah ada aset yang terkait dengan pengembalian -->
                                <option value="{{ $pengembalian->aset->id }}" selected>{{ $pengembalian->aset->namaAset }}</option>
                            @endif
                        </select>
                    </div>                                       
                    <div class="">
                        <label for="namaAset" class="block text-sm font-medium mb-2">Nama Aset</label>
                        <select id="namaAset" name="namaAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Nama Aset</option>
                            @if ($pengembalian->aset_id) <!-- Periksa apakah ada aset yang dipilih dalam pengembalian -->
                                @foreach ($aset->find($pengembalian->aset_id)->asetDetail as $detail) <!-- Ambil aset yang sesuai dengan pengembalian -->
                                    <option value="{{ $detail->id }}" {{ $pengembalian->nama_aset_id == $detail->id ? 'selected' : '' }}>{{ $detail->namaAset }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>                    
                    <div class="sm:col-span-2">
                        <label for="tglPengembalian" class="block mb-2 text-sm font-medium text-gray-90">Tanggal Pengembalian</label>
                        <input type="date" name="tglPengembalian" id="tglPengembalian" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Product brand" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900">Lokasi Pengembalian</label>
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
                    
                    <div class="sm:col-span-2">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Upload Formulir</label>
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50  hover:bg-gray-200">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" name="image" />
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
    document.getElementById('select-label').addEventListener('change', function() {
    var selectedUserId = this.value;
    var asetDropdown = document.getElementById('aset');
    var namaAsetDropdown = document.getElementById('namaAset');
    
    // Menghapus semua opsi saat ini
    asetDropdown.innerHTML = '';
    namaAsetDropdown.innerHTML = ''; // Kosongkan juga dropdown namaAset
    
    // Menambahkan opsi default
    var defaultOptionAset = document.createElement('option');
    defaultOptionAset.text = 'Pilih Aset';
    asetDropdown.add(defaultOptionAset);
    
    var defaultOptionNamaAset = document.createElement('option');
    defaultOptionNamaAset.text = 'Pilih Nama Aset';
    namaAsetDropdown.add(defaultOptionNamaAset);
    
    // Filter dan tambahkan opsi aset yang dipinjam oleh pengguna yang dipilih
    @foreach ($peminjaman as $pe)
        // Pastikan $pe adalah objek Peminjaman yang valid
        @if ($pe instanceof App\Models\Peminjaman)
            if ({{ $pe->user->id }} == selectedUserId) {
                var optionAset = document.createElement('option');
                optionAset.value = "{{ $pe->aset->id }}";
                optionAset.text = "{{ $pe->aset->namaAset }}";
                asetDropdown.add(optionAset);
                
                var optionNamaAset = document.createElement('option');
                optionNamaAset.value = "{{ $pe->asetDetail->id }}"; // Ganti dengan ID yang sesuai dari AsetDetail
                optionNamaAset.text = "{{ $pe->asetDetail->namaAset }}"; // Ganti dengan properti yang sesuai dari AsetDetail
                namaAsetDropdown.add(optionNamaAset);
            }
        @endif
    @endforeach
});

</script>
@endsection
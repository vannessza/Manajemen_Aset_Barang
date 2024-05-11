@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 m-auto">
        <div class="flex p-6">
            <a href="{{ route('peminjaman.index') }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="text-lg font-semibold text-gray-900">Edit Peminjaman</h1>
            </div>
            
        </div>
        <div class="mx-auto block max-w-xl rounded-lg bg-white p-6 shadow-4">
            <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="select-label" class="block mb-2 text-sm font-medium text-gray-900">Nama Peminjam</label>
                        <select id="select-label" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" name="namaPeminjam" data-hs-select='{
                            "placeholder": "Select assignee",
                            "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800\" data-title></span></button>",
                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1]",
                            "dropdownClasses": "mt-2 max-h-72 p-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                            "optionClasses": "py-2 px-3 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100",
                            "optionTemplate": "<div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div><div class=\"hs-selected:font-semibold text-sm text-gray-800\" data-title></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"flex-shrink-0 size-4 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"flex-shrink-0 size-3.5 text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                        }'>
                            <option value="">Pilih Nama Peminjam</option>
                            @foreach ($user as $us)
                                <option value="{{ $us->id }}" {{ $peminjaman->user_id == $us->id ? 'selected' : '' }}>{{ $us->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="aset" class="block mb-2 text-sm font-medium text-gray-900">Aset</label>
                        <select id="aset" name="aset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Aset</option>
                            @foreach ($aset as $as)
                                <option value="{{ $as->id }}" {{ $peminjaman->aset_id == $as->id ? 'selected' : '' }}>{{ $as->namaAset }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="namaAset" class="block text-sm font-medium mb-2">Nama Aset</label>
                        <select id="namaAset" name="namaAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Nama Aset</option>
                            @if ($peminjaman->aset_id)
                                @foreach ($aset->find($peminjaman->aset_id)->asetDetail as $detail)
                                    <option value="{{ $detail->id }}" {{ $peminjaman->nama_aset_id == $detail->id ? 'selected' : '' }}>{{ $detail->namaAset }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="tglPeminjaman" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Peminjaman</label>
                        <input type="date" name="tglPeminjaman" id="tglPeminjaman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Product brand" required value="{{ $peminjaman->tglPeminjaman ?? old('tglPeminjaman') }}">
                    </div>                                                            
                    <div class="sm:col-span-2">
                        <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900">Lokasi Peminjaman</label>
                        <select id="lokasi" name="lokasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Lokasi</option>
                            @foreach ($lokasi as $lo)
                                <option value="{{ $lo->id }}" {{ $peminjaman->lokasi_id == $lo->id ? 'selected' : '' }}>{{ $lo->alamat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 " placeholder="Tulis Keterangan di sini..." required value="{{ $peminjaman->keterangan }}">{{ $peminjaman->keterangan }}</textarea>                    
                    </div>
                    
                    <div class="max-w-sm">
                        <label class="block">
                            <input type="hidden" name="oldImage" value="{{ $peminjaman->image }}">
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
                @foreach ($as->asetDetail as $detail)
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
@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-36 mb-10">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl py-5 px-8 m-auto">
        <div class="flex p-6">
            <a href="{{ route('user.index') }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="text-lg font-semibold text-gray-900">Edit User</h1>
            </div>
            
        </div>
        <div class="mx-auto block max-w-xl rounded-lg bg-white p-6 shadow-4">
            <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-90">Nama</label>
                        <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan nama" value="{{ $user->name }}" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-90">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan email" value="{{ $user->email }}" required="">
                    </div>                   
                    <div class="">
                        <label for="divisi" class="block mb-2 text-sm font-medium text-gray-900">Nama Divisi</label>
                        <select id="divisi" name="divisi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Divisi</option>
                            @foreach ($divisi as $di)
                                <option value="{{ $di->id }}" {{ $di->id == $user->profile->divisi_id ? 'selected' : '' }}>{{ $di->namaDivisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="klasifikasiAset" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                        <select id="klasifikasiAset" name="klasifikasiAset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Role</option>
                            <option value="Admin"{{ $user->role === 'admin' ? 'selected' : '' }} >admin</option>
                            <option value="User" {{ $user->role === 'user' ? 'selected' : '' }} >user</option>
                        </select>
                    </div>                    
                    <div class="sm:col-span-2">
                        <label for="alamat" class="block mb-2 text-sm font-medium text-gray-90">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan alamat" value="{{ $user->profile->alamat }}" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="noTelp" class="block mb-2 text-sm font-medium text-gray-90">No Telp</label>
                        <input type="text" name="noTelp" id="noTelp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Masukkan no telp" value="{{ $user->profile->noTelp }}" required="">
                    </div>
                    <div class="sm:col-span-2 flex items-center my-auto">
                        <div class="w-1/3 flex mr-4">
                            <img class="img-preview inline-block h-40 w-40 rounded-full object-cover object-center" src="{{ $user->profile->image ? asset('storage/'. $user->profile->image) : '' }}">
                        </div>                        
                        <div class="max-w-sm">
                            <label class="block">
                                <input type="hidden" name="oldImage" value="{{ $user->profile->image }}">
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
                </div>
                <button type="submit" class="inline-block w-full rounded bg-[#B8BC00] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong" data-twe-ripple-init data-twe-ripple-color="light">
                    Edit
                </button>
                <div class="w-full text-center mt-2">
                     <a href="{{ route('user.password.edit', $user->id) }}" class="text-blue-600 hover:underline hover:text-primary-dark">Ubah Password</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
    }
</script>

@endsection

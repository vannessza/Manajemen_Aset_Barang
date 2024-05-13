@extends('dashboard.layouts.main')

@section('container')

<section class="container mt-36 mb-10">
    <div class="bg-white max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto mt-24 rounded-t-xl">
        <div class="flex mb-10">
            <a href="{{ route('admin.index') }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="text-2xl font-semibold text-gray-900">Profile Admin</h1>
            </div>
        </div>
        <div class="lg:flex justify-between">
            {{-- <div class="flex items-center gap-x-3 mb-8 lg:w-1/2 block lg:hidden">
                <div class="">
                    @if ($user->profile->image)
                        <img src="{{ asset('storage/'. $user->profile->image) }}" alt="User Image" class="inline-block h-20 w-20 lg:w-40 lg:h-40 rounded-full">
                        <p class="text-center  text-sm font-medium mt-3"><span class="bg-teal-100 text-teal-800 rounded-lg px-2 py-1.5">{{ $user->role }}</span></p>
                    @else
                        <img src="{{ asset('image/icon/no_image.png') }}" alt="Default Image" class="inline-block h-20 w-20 rounded-full">
                        <p class="text-center  text-sm font-medium mt-3"><span class="bg-teal-100 text-teal-800 rounded-lg px-2 py-1.5">{{ $user->role }}</span></p>
                    @endif
                </div>
                <div>
                    <h2 class="text-xl font-semibold leading-none text-gray-900 md:text-2xl">{{ $user->name }} 
                    </h2>
                    <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400 text-sm">{{ $user->profile->divisi->namaDivisi }}</p>
                </div>
            </div> --}}
            <div class="items-center gap-x-3 mb-8 lg:w-1/2 lg:block text-center">
                <div class="">
                    @if ($admin->profile->image)
                        <img src="{{ asset('storage/'. $admin->profile->image) }}" alt="User Image" class="inline-block h-20 w-20 lg:w-52 lg:h-52 rounded-full">
                    @else
                        <img src="{{ asset('image/icon/User.png') }}" alt="Default Image" class="inline-block h-20 w-20 rounded-full">
                    @endif
                    
                </div>
                <div class="mt-2">
                    <span class="py-1.5 px-2 text-sm font-medium bg-teal-100 text-teal-800 rounded-lg">
                        {{ $admin->role }}
                    </span>
                    <h2 class="text-xl font-semibold leading-none text-gray-900 md:text-2xl">{{ $admin->name }} 
                    </h2>
                    <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400 text-sm">{{ $admin->profile->divisi->namaDivisi }}</p>
                </div>
            </div>
            <div>
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900">Email</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $admin->email }}</dd>
            </dl>
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900">Alamat</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $admin->profile->alamat }}</dd>
            </dl>
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900">No Telp</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $admin->profile->noTelp }}</dd>
            </dl>
            <dl class="flex space-x-6">
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900">Total Aset</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $jumlahPeminjaman }}</dd>
                </div>
            </dl>
        </div>
        </div>
    </div>
  </section>
  <section class="container -mt-12">
    <div class="bg-white max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto mt-24">
        <nav class="" aria-label="Jump links">
            <div class="max-w-7xl snap-x w-full flex items-center overflow-x-auto mx-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
                <div class="snap-center shrink-0 pe-5 sm:pe-8 sm:last-pe-0">
                    <a class="inline-flex items-center gap-x-2 hover:text-gray-500 {{ request()->routeIs('admin.show.daftaraset') ? 'text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : '' }}" href="{{ route('admin.show.daftaraset', $admin->id) }}">Daftar Aset</a>
                </div>
                <div class="snap-center shrink-0 pe-5 sm:pe-8 sm:last:pe-0">
                    <a class="inline-flex items-center gap-x-2 hover:text-gray-500 {{ request()->routeIs('admin.show.history') ? 'text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : '' }}" href="{{ route('admin.show.history', $admin->id) }}">History</a>
                </div>
            </div>
        </nav>               
    </div>
  </section>  
  <section>
    @yield('user')
  </section>

@endsection
@extends('dashboard.layouts.main')

@section('container')

<section class="container mt-36 mb-10">
    <div class="bg-white max-w-[85rem] px-8 py-10 sm:px-8 lg:px-8 lg:py-14 mx-auto mt-24 rounded-t-xl">
        <div class="flex mb-10">
            <a href="{{ route('dashboard.index') }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="text-2xl font-semibold text-gray-900 mr-8">Profile</h1>
            </div>
        </div>
        <div class="lg:flex justify-between w-full sm:px-6 lg:px-8 lg:py-14 mx-auto">
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
                    @if ($user->profile->image)
                        <img src="{{ asset('storage/'. $user->profile->image) }}" alt="User Image" class="inline-block h-20 w-20 lg:w-52 lg:h-52 rounded-full">
                    @else
                        <img src="{{ asset('image/icon/User.png') }}" alt="Default Image" class="inline-block h-20 w-20 rounded-full">
                    @endif
                    
                </div>
                <div class="mt-2">
                    <span class="py-1.5 px-2 text-sm font-medium bg-teal-100 text-teal-800 rounded-lg">
                        {{ $user->role }}
                    </span>
                    <h2 class="text-xl font-semibold leading-none text-gray-900 md:text-2xl">{{ $user->name }} 
                    </h2>
                    <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400 text-sm">{{ $user->profile->divisi->namaDivisi }}</p>
                </div>
            </div>
            <div>
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900">Email</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $user->email }}</dd>
            </dl>
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900">Alamat</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $user->profile->alamat }}</dd>
            </dl>
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900">No Telp</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $user->profile->noTelp }}</dd>
            </dl>
        </div>
        </div>
        <div class="">
            <!-- Card Section -->
            <div class="w-full sm:px-6 lg:px-8 mx-auto">
                <p class="mb-2 font-semibold leading-none text-gray-900">Info</p>
                <!-- Grid -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <!-- Card -->
                <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                    <div class="p-4 md:p-5 flex justify-between gap-x-3">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-[#3051FF]">
                        Total Peminjaman
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-sm sm:text-2sm font-medium text-gray-800">
                            Jumlah Peminjaman
                        </h3>
                        </div>
                    </div>
                    <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-[#3051FF] text-white rounded-full">
                        {{ $jumlahPeminjaman }}
                    </div>
                    </div>
                </div>
                <!-- End Card -->
            
                <!-- Card -->
                <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                    <div class="p-4 md:p-5 flex justify-between gap-x-3">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-[#00FFF0]">
                        Sessions
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-sm sm:text-2sm font-medium text-gray-800">
                            Jumlah Pengembalian
                        </h3>
                        </div>
                    </div>
                        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-[#00FFF0] text-white rounded-full">
                            {{ $jumlahPengembalian }}
                        </div>
                    </div>
                </div>
                <!-- End Card -->
                </div>
                <!-- End Grid -->
            </div>
            <div class="mt-5 sm:px-6 lg:px-8 mx-auto">
                <p class="mb-2 font-semibold leading-none text-gray-900">Edit Profile</p>
                <a href="{{ route('profile.edit') }}" class="inline-flex rounded bg-[#B8BC00] hover:bg-[#8b8d14] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2">
                    <svg class="w-6 h-6 inline-block mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z"/>
                    </svg>
                    Edit
                </a>            
                <a href="{{ route('profile.editpassword') }}" class="inline-flex items-center rounded bg-blue-600 hover:bg-blue-700 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2">
                    <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                    </svg>
                    Ubah Password
                </a>            
            </div>
        </div>
    </div>
  </section>
  <section class="container -mt-12">
    <div class="bg-white max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto mt-24">
        <nav class="" aria-label="Jump links">
            <div class="max-w-7xl snap-x w-full flex items-center overflow-x-auto mx-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
                <div class="snap-center shrink-0 pe-5 sm:pe-8 sm:last-pe-0">
                    <a class="inline-flex items-center gap-x-2 hover:text-gray-500 {{ request()->routeIs('profile.daftaraset') ? 'text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : '' }}" href="{{ route('profile.daftaraset') }}">Daftar Aset</a>
                </div>
                <div class="snap-center shrink-0 pe-5 sm:pe-8 sm:last:pe-0">
                    <a class="inline-flex items-center gap-x-2 hover:text-gray-500 {{ request()->routeIs('profile.history') ? 'text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : '' }}" href="{{ route('profile.history') }}">History</a>
                </div>
            </div>
        </nav>               
    </div>
  </section>  
  <section>
    @yield('profile')
  </section>


@endsection
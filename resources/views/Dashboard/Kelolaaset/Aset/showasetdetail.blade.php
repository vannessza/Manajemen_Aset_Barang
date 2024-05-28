@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10 md:block hidden">
    <div class="bg-white mx-auto rounded-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 max-w-4xl">
        <section class="bg-white">
            <div class="px-4 mx-auto max-w-4xl">
                <a href="{{ route('aset.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
               </a>
                <div class="flex">
                    <div class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden w-9/12">
                        @if ($asetDetail->image)
                            <img src="{{ asset('storage/'. $asetDetail->image) }}" alt="Default Image" class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl">
                        @else
                            <img src="{{ asset('image/icon/no_image.png') }}" alt="Default Image" class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl">
                        @endif
                    </div>
                    <div>
                        <p class="mb-2 font-semibold leading-none text-gray-90">Aset</p>
                        <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->aset->namaAset }}</p>
                        <p class="mb-2 font-semibold leading-none text-gray-90">Jenis Aset</p>
                        <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->jenisAset}}</p>
                        <p class="mb-2 font-semibold leading-none text-gray-90">Masa Retensi</p>
                        <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->masaRetensi}} Tahun</p>
                        <p class="mb-2 font-semibold leading-none text-gray-90">Tanggal Pembelian</p>
                        <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->tglPembelian}}</p>
                        <p class="mb-2 font-semibold leading-none text-gray-90">Jumlah</p>
                        <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->jumlah}}</p>
                    </div>
                </div>
                <h2 class="mb-4 text-xl font-semibold leading-none text-gray-900 md:text-2xl mt-4">{{ $asetDetail->namaAset }}</h2>
                <dl>
                    <dt class="mb-2 font-semibold leading-none text-gray-900">Detail Aset</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->detailAset }}</dd>
                </dl>
                </a>
                <div class="flex justify-center">
                    <a href="{{ route('aset.pinjam', $asetDetail->id) }}" class="bg-[#008d8d] px-5
                    py-2 rounded-full text-white font-semibold
                    font-inter block w-40 xl:w-56 hover:bg-[#006c6c] text-center">Pinjam</a>
                </div>
            </div>
          </section>
    </div>
</div>

<section class="container mt-36 mb-10 md:hidden block">
    <div class="bg-white max-w-4xl px-8 py-10 sm:px-8 lg:px-8 lg:py-14 mx-auto mt-24 rounded-t-xl">
        <div class="flex mb-10">
            <a href="{{ route('aset.index') }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
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
                    @if ($asetDetail->image)
                        <img src="{{ asset('storage/'. $asetDetail->image) }}" alt="User Image" class="inline-block h-20 w-20 lg:w-52 lg:h-52">
                    @else
                        <img src="{{ asset('image/icon/no_image.png') }}" alt="Default Image" class="inline-block h-20 w-20 lg:w-52 lg:h-52">
                    @endif
                    
                </div>
                <div class="mt-2">
                    <span class="py-1.5 px-2 text-sm font-medium bg-teal-100 text-teal-800 rounded-lg">
                        {{ $asetDetail->aset->namaAset }}
                    </span>
                    <h2 class="text-xl font-semibold leading-none text-gray-900 md:text-2xl">{{ $asetDetail->namaAset }} 
                    </h2>
                </div>
            </div>
            <div>
            <div class="lg:mr-20">
                <div>
                    <dl>
                        <dt class="mb-2 font-semibold leading-none text-gray-900">Jenis Aset</dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->jenisAset }}</dd>
                    </dl>
                    <dl>
                        <dt class="mb-2 font-semibold leading-none text-gray-900">Masa Retensi</dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->masaRetensi }}</dd>
                    </dl>
                    <dl>
                        <dt class="mb-2 font-semibold leading-none text-gray-900">Jumlah</dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->jumlah }}</dd>
                    </dl>
                </div>
                <div>
                    <dl>
                        <dt class="mb-2 font-semibold leading-none text-gray-900">Status</dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->status }}</dd>
                    </dl>
                    <dl>
                        <dt class="mb-2 font-semibold leading-none text-gray-900">Masa Retensi</dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->masaRetensi }} Tahun</dd>
                    </dl>
                    <dl>
                        <dt class="mb-2 font-semibold leading-none text-gray-900">Tanggal Pembelian</dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->tglPembelian }}</dd>
                    </dl>
                </div>
            </div>
            
        </div>
        </div>
        <div class="">
            <div class="mt-5 sm:px-6 lg:px-8 mx-auto w-full">
                <p class="mb-2 font-semibold leading-none text-gray-900">Detail Aset</p>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->detailAset }}</p>
            </div>
        </div>
        <div class="flex justify-center">
            <a href="{{ route('aset.pinjam', $asetDetail->id) }}" class="bg-[#008d8d] px-5
            py-2 rounded-full text-white font-semibold
            font-inter block w-40 xl:w-56 hover:bg-[#006c6c] text-center">Pinjam</a>
        </div>
    </div>
    
  </section>
@endsection
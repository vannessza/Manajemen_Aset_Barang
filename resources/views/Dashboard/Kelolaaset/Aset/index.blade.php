@extends('dashboard.layouts.main')

@section('container')

<!-- Card Blog -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto mt-24">
    <!-- Title -->
    <div class="text-center mb-10 lg:mb-14 flex justify-center"> <!-- Tambahkan class justify-center di sini -->
      <form action="" method="GET" class="flex items-center mx-auto"> <!-- Tambahkan class mx-auto di sini -->
        <input type="text" name="query" class="border px-4 py-2 rounded-md w-62 md:w-72 xl:w-96" placeholder="Cari Aset...">
        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md">Cari</button>
      </form>
    </div>
    <!-- End Title -->
    <div class="flex mb-10 lg:mb-14">
        @foreach ($aset as $as)
          <a href="" class="mr-6 bg-white px-3 py-2 rounded-xl shadow-xl font-sans hover:bg-slate-400 hover:text-slate-100">{{ $as->namaAset }}</a>
        @endforeach
    </div>
    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Card -->
      @foreach ($asetDetail as $ad)
      <a class="group bg-white p-5 rounded-xl shadow-xl" href="{{ route('aset.show', $ad->id) }}">
        <div class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden">
          @if ($ad->image)
            <img src="{{ asset('image/icon/no_image.png') }}" alt="Default Image" class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl">
          @else
            <img src="{{ asset('image/icon/no_image.png') }}" alt="Default Image" class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl">
          @endif
        </div>

        <div class="mt-7">
          <h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600">
            {{ $ad->namaAset }}
          </h3>
          <p class="mt-3 text-gray-800">
            {{ $ad->jenisAset }}
          </p>
          <p class="mt-5 inline-flex items-center gap-x-1 text-blue-600 decoration-2 group-hover:underline font-medium">
            Read more
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
          </p>
        </div>
      </a>
      @endforeach
    </div>
    <!-- End Grid -->
  </div>
  <!-- End Card Blog -->

@endsection
@extends('dashboard.layouts.main')

@section('container')

<!-- Card Blog -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto mt-24">
    <!-- Title -->
    <div class="text-center mb-10 lg:mb-14 flex justify-center">
        <form action="" method="GET" class="flex items-center mx-auto">
            <input type="hidden" name="query" value="{{ request('query') }}">
            <input type="text" name="query" class="border px-4 py-2 rounded-md w-62 md:w-72 xl:w-96" placeholder="Cari Aset..." value="{{ request('query') }}">
            <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md">Cari</button>
        </form>
    </div>
    <!-- End Title -->

    <div class="relative">
        @if(count($aset) > 10)
            <!-- Panah Kiri -->
            <button id="left-arrow" class="absolute left-0 z-10 h-full bg-white bg-opacity-75 hover:bg-opacity-100" style="top: 50%; transform: translateY(-50%); width: 30px; height: 100%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 24px; background-color: rgba(255, 255, 255, 0.75);">
                &#9664;
            </button>
        @endif

        <div class="flex mb-10 lg:mb-14 overflow-x-auto" id="scroll-container" style="scrollbar-width: none; -ms-overflow-style: none;">
            <style>
                #scroll-container::-webkit-scrollbar {
                    width: 0px;  /* Menghilangkan ruang scrollbar */
                    background: transparent;  /* Opsional: membuat scrollbar tidak terlihat */
                }
            </style>
            @foreach ($aset as $as)
                <a href="{{ route('kategori.index', $as->id) }}" class="mr-6 bg-white px-3 py-2 rounded-xl shadow-xl font-sans hover:bg-slate-400 hover:text-slate-100">{{ $as->namaAset }}</a>
            @endforeach
        </div>

        @if(count($aset) > 10)
            <!-- Panah Kanan -->
            <button id="right-arrow" class="absolute right-0 z-10 h-full bg-white bg-opacity-75 hover:bg-opacity-100" style="top: 50%; transform: translateY(-50%); width: 30px; height: 100%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 24px; background-color: rgba(255, 255, 255, 0.75);">
                &#9654;
            </button>
        @endif
    </div>

    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($asetDetail as $ad)
            <a class="group bg-white p-5 rounded-xl shadow-xl" href="{{ route('aset.show', $ad->id) }}">
                <div class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden">
                    @if ($ad->image)
                        <img src="{{ asset('storage/'. $ad->image) }}" alt="Default Image" class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl">
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

    <div class="text-center mb-10 mt-10">
        <div class="inline-flex gap-x-2">
            @if ($asetDetail->previousPageUrl())
                <a href="{{ $asetDetail->previousPageUrl() }}" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Prev
                </a>
            @else
                <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Prev
                </button>
            @endif

            @if ($asetDetail->nextPageUrl())
                <a href="{{ $asetDetail->nextPageUrl() }}" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                    Next
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </a>
            @else
                <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                    Next
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </button>
            @endif
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', () => {
    const scrollContainer = document.getElementById('scroll-container');
    const leftArrow = document.getElementById('left-arrow');
    const rightArrow = document.getElementById('right-arrow');

    if (leftArrow) {
        leftArrow.addEventListener('click', () => {
            scrollContainer.scrollBy({ left: -200, behavior: 'smooth' });
        });
    }

    if (rightArrow) {
        rightArrow.addEventListener('click', () => {
            scrollContainer.scrollBy({ left: 200, behavior: 'smooth' });
        });
    }
});
</script>

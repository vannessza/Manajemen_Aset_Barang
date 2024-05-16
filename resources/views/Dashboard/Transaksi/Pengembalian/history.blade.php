@extends('dashboard.transaksi.pengembalian.index')

@section('pengembalian')
@if(count($pengembalian) > 0)
<div class="relative max-w-xs ml-2 mb-4">
  <form method="GET" action="{{ route('pengembalian.history') }}">
      <label class="sr-only">Search</label>
      <input type="text" name="search" id="hs-table-with-pagination-search" value="{{ request('search') }}" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Search for items">
      <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
        <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <path d="m21 21-4.3-4.3"></path>
        </svg>
      </div>
  </form>
</div>
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-3 text-start">
          <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
              kode Peminjaman
            </span>
          </div>
        </th>

        <th scope="col" class="px-6 py-3 text-start">
          <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
              Nama
            </span>
          </div>
        </th>

        <th scope="col" class="px-6 py-3 text-start">
          <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
              Aset
            </span>
          </div>
        </th>

        <th scope="col" class="px-6 py-3 text-start">
          <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
              Tanggal Peminjaman
            </span>
          </div>
        </th>
        <th scope="col" class="px-6 py-3 text-start">
          <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
              Status
            </span>
          </div>
        </th>

        <th scope="col" class="px-6 py-3 text-end"></th>
      </tr>
    </thead>
    
    <tbody class="divide-y divide-gray-200">
      @php ($i = 0)
      @foreach ($pengembalian as $pe)
      @php($i++)
      <tr>
        <td class="whitespace-nowrap">
          <div class="px-6 py-3">
            <span class="text-sm text-gray-500" style="max-width: 150px;">{{ $pe->kodePengembalian ? $pe->kodePengembalian : 'XXXX/XXX/XXX/XX' }}</span>
          </div>
        </td>
        <td class="whitespace-nowrap">
          <div class="px-6 py-3">
              <div class="flex items-center gap-x-3">
                  @if ($pe->user->profile->image)
                      <img src="{{ asset('storage/'. $pe->user->profile->image) }}" alt="User Image" class="inline-block h-10 w-10 rounded-full">
                  @else
                      <img src="{{ asset('image/icon/User.png') }}" alt="Default Image" class="inline-block h-10 w-10 rounded-full">
                  @endif
                  <div class="grow">
                      <span class="block text-sm font-semibold text-gray-800">{{ $pe->user->name }}</span>
                      <span class="block text-sm text-gray-500">{{ $pe->user->profile->divisi->kodeDivisi }}</span>
                  </div>
              </div>
          </div>
      </td>                
        <td class="whitespace-nowrap">
          <div class="px-6 py-3">
            <span class="block text-sm font-semibold text-gray-800">{{ $pe->asetDetail->namaAset }}</span>
            <span class="block text-sm text-gray-500">{{ $pe->aset->namaAset }}</span>
          </div>
        </td>
        <td class="whitespace-nowrap">
          <div class="px-6 py-3">
            <span class="text-sm text-gray-500" style="max-width: 150px;">{{ $pe->tglPengembalian }}</span>
          </div>
        </td>
      <td class="whitespace-nowrap">
        <div class="px-6 py-3">
          <span class="text-sm @if ($pe->status === 'Dikembalikan')
            text-green-600 font-semibold
        @elseif($pe->status === 'Diproses')
            text-yellow-600 font-semibold
        @elseif($pe->status === 'Ditolak')
            text-red-600 font-semibold
        @endif" style="max-width: 150px;">{{ $pe->status }}</span>
        </div>
      </td>
      </td>
        <td class="whitespace-nowrap">
          <div class="px-6 py-1.5">
            @if ($pe->status === 'Diproses')
            <a class="inline-flex items-center gap-x-1 text-sm text-slate-500 hover:text-slate-700 disabled:opacity-50 decoration-2 hover:underline font-medium" href="{{ route('pengembalianhistory.show', $pe->id) }}">
              Detail
            </a>
            <a class="inline-flex items-center gap-x-1 text-sm text-green-500 hover:text-green-800 disabled:opacity-50 decoration-2 hover:underline font-medium" href="{{ route('pengembalian.edit', $pe->id) }}">
              Edit
            </a>
            <a class="inline-flex items-center gap-x-1 text-sm text-red-500 hover:text-red-800 decoration-2 hover:underline font-medium" href="{{ route('pengembalian.delete', $pe->id) }}">
              Delete
            </a>
            @else
                <a class="inline-flex items-center gap-x-1 text-sm text-slate-500 hover:text-slate-700 disabled:opacity-50 decoration-2 hover:underline font-medium" href="{{ route('peminjamanhistory.show', $pe->id) }}">
                    Detail
                </a>
                <a class="inline-flex items-center gap-x-1 text-sm text-red-500 hover:text-red-800 decoration-2 hover:underline font-medium" href="{{ route('pengembalian.delete', $pe->id) }}">
                  Delete
                </a>
            @endif
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <!-- End Table -->

  <!-- Footer -->
  <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
    <div>
      <p class="text-sm text-gray-600">
        <span class="font-semibold text-gray-800">{{ count($pengembalian) }}</span> results
      </p>
    </div>

    <div class="">
      <div class="inline-flex gap-x-2">
          @if ($pengembalian->previousPageUrl())
              <a href="{{ $pengembalian->previousPageUrl() }}" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                  <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                  Prev
              </a>
          @else
              <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                  <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                  Prev
              </button>
          @endif

          @if ($pengembalian->nextPageUrl())
              <a href="{{ $pengembalian->nextPageUrl() }}" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
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
  @else
  <div class="alert alert-info mt-10 text-center">
      Belum ada data yang tersedia.
  </div>
  @endif
@endsection
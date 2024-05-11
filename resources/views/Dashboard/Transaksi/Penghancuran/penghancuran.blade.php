@extends('dashboard.transaksi.penghancuran.index')

@section('penghancuran')
@if(count($penghancuran) > 0)
<div class="relative max-w-xs ml-2">
    <label class="sr-only">Search</label>
    <input type="text" name="hs-table-with-pagination-search" id="hs-table-with-pagination-search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Search for items">
    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
      <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"></circle>
        <path d="m21 21-4.3-4.3"></path>
      </svg>
    </div>
</div>
  <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
              <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                No
              </span>
            </div>
          </th>

          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
              <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                Nama Aset
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
                Tipe Pemusnahan
              </span>
            </div>
          </th>

          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
              <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                Tanggal Penghancuran
              </span>
            </div>
          </th>
          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
              <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                Penerima
              </span>
            </div>
          </th>
          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
              <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                Pemohon
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
        @foreach ($penghancuran as $pe)
        @php($i++)
        <tr>
          <td class="whitespace-nowrap">
            <div class="px-6 py-3">
              <span class="text-sm text-gray-500" style="max-width: 150px;">{{ $i }}</span>
            </div>
          </td>
          <td class="whitespace-nowrap">
            <div class="px-6 py-3">
              <span class="text-sm text-gray-500" style="max-width: 150px;">{{ $pe->nama_aset }}</span>
            </div>
          </td>
          <td class="whitespace-nowrap">
            <div class="px-6 py-3">
              <span class="text-sm text-gray-500" style="max-width: 150px;">{{ $pe->aset->namaAset }}</span>
            </div>
          </td>
        <td class="whitespace-nowrap">
          <div class="px-6 py-3">
            <span class="text-sm text-gray-500" style="max-width: 150px;">{{ $pe->tipePemusnahan }}</span>
          </div>
        </td>               
          
          <td class="whitespace-nowrap">
            <div class="px-6 py-3">
              <span class="text-sm text-gray-500" style="max-width: 150px;">{{ $pe->tglPemusnahan }}</span>
            </div>
          </td>
          <td class="whitespace-nowrap">
            @if($pe->pengesahan)
            <div class="px-6 py-3">
              <span class="block text-sm font-semibold text-gray-800">{{ $pe->userpengesahan->name }}</span>
              <span class="block text-sm text-gray-500">{{ $pe->userpengesahan->profile->divisi->kodeDivisi }}</span>
            </div>
            @else
            <div class="px-6 py-3">
              <span class="text-sm text-gray-500" style="max-width: 150px;">none</span>
            </div>
            @endif
          </td>
          <td class="whitespace-nowrap">
            <div class="px-6 py-3">
              <span class="block text-sm font-semibold text-gray-800">{{ $pe->userpemohon->name }}</span>
              <span class="block text-sm text-gray-500">{{ $pe->userpemohon->profile->divisi->kodeDivisi }}</span>
            </div>
          </td>
        <td class="whitespace-nowrap">
          <div class="px-6 py-3">
            <span class="text-sm @if ($pe->status === 'Disetujui')
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
              @if($pe->status === 'Disetujui')
                <a class="inline-flex items-center gap-x-1 text-sm text-slate-500 hover:text-slate-700 disabled:opacity-50 decoration-2 hover:underline font-medium" href="">
                  Detail
                </a>
              @else
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
          <span class="font-semibold text-gray-800">12</span> results
        </p>
      </div>

      <div>
        <div class="inline-flex gap-x-2">
          <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            Prev
          </button>

          <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
            Next
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
          </button>
        </div>
      </div>
    </div>
    @else
    <div class="alert alert-info mt-10 text-center">
        Belum ada data yang tersedia.
    </div>
    @endif

@endsection
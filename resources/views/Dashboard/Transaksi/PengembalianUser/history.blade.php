@extends('dashboard.transaksi.pengembalianuser.index')

@section('pengembalian')
@if(count($pengembalian) > 0)
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
  <div class="overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No</th>
          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Kode Peminjaman</th>
          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama</th>
          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Aset</th>
          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal Pengembalian</th>
          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status</th>
          <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
        </tr>
      </thead>
      
      <tbody class="divide-y divide-gray-200">
        
        @php ($i = 0)
        @foreach ($pengembalian as $pe)
        @php($i++)
        <tr>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $i }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->kodePengembalian ? $pe->kodePengembalian : 'XXXX/XXX/XXX/XX' }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->asetdetail->namaAset }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->aset->namaAset }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->tglPengembalian }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm 
            @if ($pe->status === 'Dikembalikan')
                text-green-600 font-semibold
            @elseif($pe->status === 'Diproses')
                text-yellow-600 font-semibold
            @elseif($pe->status === 'Ditolak')
                text-red-600 font-semibold
            @endif">{{ $pe->status }}</td>
            @if ($pe->status === 'Diproses')
                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                    <a class="inline-flex items-center gap-x-1 text-sm text-slate-500 hover:text-slate-700 disabled:opacity-50 decoration-2 hover:underline font-medium" href="{{ route('pengembalianhistory.show.user', $pe->id) }}">
                        Detail
                    </a>
                    <a class="inline-flex items-center gap-x-1 text-sm text-green-500 hover:text-green-800 disabled:opacity-50 decoration-2 hover:underline font-medium" href="{{ route('pengembalian.edit.user', $pe->id) }}">
                        Edit
                    </a>
                    <a class="inline-flex items-center gap-x-1 text-sm text-red-500 hover:text-red-800 decoration-2 hover:underline font-medium" href="{{ route('pengembalian.delete.user', $pe->id) }}">
                        Delete
                    </a>
                </td>
            @else
                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                    <a class="inline-flex items-center gap-x-1 text-sm text-slate-500 hover:text-slate-700 disabled:opacity-50 decoration-2 hover:underline font-medium" href="{{ route('pengembalian.show.user', $pe->id) }}">
                        Detail
                    </a>
                </td>
            @endif
        </tr>
        @endforeach
      </tbody>
      
    </table>
  </div>
  @else
  <div class="alert alert-info mt-10 text-center">
      Belum ada data yang tersedia.
  </div>
  @endif
  @endsection
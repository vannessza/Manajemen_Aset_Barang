@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10">
    <div class="bg-white w-auto rounded-xl shadow-xl py-5 px-8">
        <div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Detail Aset Register</h1>
            </div>
            <div>
                <div class="flex">
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold w-1/2">Aset</p>
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold">{{ $aset->kodeAset }}</p>
                </div>
                <div class="flex">
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold w-1/2">Aset</p>
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold">{{ $aset->namaAset}}</p>
                </div>
                <div class="flex">
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold w-1/2">Jenis Aset</p>
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold">{{ $aset->jenisAset}}</p>
                </div>
                <div class="flex">
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold w-1/2">Klasifikasi Aset</p>
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold">{{ $aset->klasifikasiAset}}</p>
                </div>
                <div class="flex">
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold w-1/2">CIA Level</p>
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold">{{ $aset->ciaLevel}}</p>
                </div>
                <div class="flex">
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold w-1/2">Aset Valuation</p>
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold">{{ $aset->asetValuation}}</p>
                </div>
                <div class="flex">
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold w-1/2">Nilai Risiko</p>
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold">{{ $aset->nilaiRisiko}}</p>
                </div>
                <div class="flex">
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold w-1/2">Masa Retensi</p>
                    <p class="pt-4 whitespace-nowrap text-md text-gray-800 text-bold">{{ $aset->masaRetensi}}</p>
                </div>
            </div>
        </div>
        <div class="flex justify-between items-center mt-10">
            <h1 class="text-xl font-bold text-gray-800">Aset Register</h1>
            <a href="{{ route('detailaset.create', [$aset->id]) }}" class="bg-[#00C74F] text-white py-2 px-4 rounded-md shadow-xl">Tambah</a>
        </div>
        <div class="flex flex-col mt-10">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="border rounded-lg divide-y divide-gray-200">
                  <div class="py-3 px-4">
                    <div class="relative max-w-xs">
                      <label class="sr-only">Search</label>
                      <input type="text" name="hs-table-with-pagination-search" id="hs-table-with-pagination-search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Search for items">
                      <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                        <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <circle cx="11" cy="11" r="8"></circle>
                          <path d="m21 21-4.3-4.3"></path>
                        </svg>
                      </div>
                    </div>
                  </div>
                  @if(count($aset->asetDetail) > 0)
                  <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-gray-50">
                        <tr>
                          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No</th>
                          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama Aset</th>
                          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Jenis Aset</th>
                          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Klasifikasi Aset</th>
                          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status</th>
                          <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200">
                        
                        @php ($i = 0)
                        @foreach ($aset->asetDetail as $ad)
                        @php($i++)
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $i }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $ad['namaAset'] }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $ad['jenisAset'] }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $ad['klasifikasiAset'] }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $ad['jumlah'] }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $ad['status'] }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                            <a href="{{ route('detailaset.show', $ad->id) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-slate-500 hover:text-slate-700 disabled:opacity-50 disabled:pointer-events-none">Detail</a>
                            <a href="" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-green-500 hover:text-green-800 disabled:opacity-50 disabled:pointer-events-none">Edit</a>
                            <a href="" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-500 hover:text-red-800 disabled:opacity-50 disabled:pointer-events-none">Delete</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  @else
                  <div class="alert alert-info text-center">
                      Belum ada data yang tersedia.
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@extends('dashboard.akun.admin.showadmin')

@section('user')

<div class="container -mt-10 mb-10">
    <div class="bg-white w-auto rounded-b-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="md:flex justify-between items-center">
          <div>
            <h1 class="text-xl font-semibold text-gray-800">Daftar Aset</h1>
            <p class="text-sm text-gray-600">Peminjaman/Detail/Pengembalian</p>
          </div>
          <div class="mt-4 md:mt-0">
                <div class="inline-flex gap-x-2">
                  <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-[#00C74F] text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('admin.show.tambahaset.create', $admin->id) }}">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Tambah Aset
                  </a>
                </div>
              </div>
        </div>
        @if(count($peminjaman) > 0)
        <div class="flex flex-col mt-10">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="border rounded-lg divide-y divide-gray-200">
                  {{-- <div class="py-3 px-4">
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
                  </div> --}}
                  <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                          <tr>
                            <th scope="col" class="px-6 py-3 text-start">
                              <div class="flex items-center gap-x-2">
                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                  Kode Peminjaman
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
                          @foreach ($peminjaman as $pe)
                          @php($i++)
                          <tr>
                            <td class="whitespace-nowrap">
                              <div class="px-6 py-3">
                                <span class="block text-sm text-gray-500">{{ $pe->kodePeminjaman ? $pe->kodePeminjaman : 'XXXX/XXX/XXX/XX' }}</span>
                              </div>
                          </td>                
                            <td class="whitespace-nowrap">
                              <div class="px-6 py-3">
                                <div class="flex items-center gap-x-3">
                                    @if ($pe->asetDetail->image)
                                        <img src="{{ asset('storage/'. $us->profile->image) }}" alt="User Image" class="inline-block h-10 w-10 rounded-full">
                                    @else
                                        <img src="{{ asset('image/icon/no_image.png') }}" alt="Default Image" class="inline-block h-10 w-10 rounded-full">
                                    @endif
                                    <div class="grow">
                                        <span class="block text-sm font-semibold text-gray-800">{{ $pe->asetDetail->namaAset }}</span>
                                        <span class="block text-sm text-gray-500">{{ $pe->asetDetail->jenisAset }}</span>
                                    </div>
                                </div>
                              </div>
                            </td>
                            <td class="whitespace-nowrap">
                              <div class="px-6 py-3">
                                  <span class="py-1 px-1.5 items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-r-xl">
                                    {{ $pe->aset->namaAset }}
                                  </span>
                              </div>
                          </td>
                          <td class="whitespace-nowrap">
                            <div class="px-6 py-3">
                              <span class="text-sm text-gray-500" style="max-width: 150px;">{{ $pe->tglPeminjaman }}</span>
                            </div>
                          </td>
                          
                            <td class="whitespace-nowrap">
                              <div class="px-6 py-3">
                                <span class="text-sm @if ($pe->status === 'Diterima')
                                    text-green-600 font-semibold
                                @elseif($pe->status === 'Diproses')
                                    text-yellow-600 font-semibold
                                @elseif($pe->status === 'Ditolak')
                                    text-red-600 font-semibold
                                @endif">{{ $pe->status }}</span>
                              </div>
                            </td>
                            @if ($pe->status === 'Diterima')
                            <td class="whitespace-nowrap">
                                <div class="px-6 py-1.5">
                                     <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline font-medium" href="{{ route('admin.show.daftaraset.showhistory', ['user_id' => $admin->id, 'peminjaman_id' => $pe->id]) }}">
                                        Detail
                                    </a>
                                    <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline font-medium" href="{{ route('admin.show.daftaraset.pengembalian', ['user_id' => $admin->id, 'peminjaman_id' => $pe->id]) }}">
                                        Pengembalian
                                    </a>
                                </div>
                            </td>
                            @else
                            <td class="whitespace-nowrap">
                              <div class="px-6 py-1.5">
                                <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline font-medium" href="{{ route('admin.show.daftaraset.showhistory', ['user_id' => $admin->id, 'peminjaman_id' => $pe->id]) }}">
                                    Detail
                               </a>
                            </div>
                            </td>
                            @endif
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <!-- End Table -->
            
                      <!-- Footer -->
                      <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
                        <div>
                          <p class="text-sm text-gray-600">
                            <span class="font-semibold text-gray-800">{{ count($peminjaman) }}</span> results
                          </p>
                        </div>
            
                        <div class="">
                          <div class="inline-flex gap-x-2">
                              @if ($peminjaman->previousPageUrl())
                                  <a href="{{ $peminjaman->previousPageUrl() }}" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                                      <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                      Prev
                                  </a>
                              @else
                                  <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                      <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                      Prev
                                  </button>
                              @endif
                    
                              @if ($peminjaman->nextPageUrl())
                                  <a href="{{ $peminjaman->nextPageUrl() }}" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @else
        <div class="alert alert-info mt-10 text-center">
            Belum ada data yang tersedia.
        </div>
        @endif
    </div>
</div>

@endsection
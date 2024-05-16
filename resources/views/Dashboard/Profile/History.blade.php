@extends('dashboard.profile.index')

@section('profile')

<div class="container -mt-10 mb-10">
    <div class="bg-white w-auto rounded-b-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="md:flex justify-between items-center">
          <div>
            <h1 class="text-xl font-semibold text-gray-800">History</h1>
          </div>
        </div>
        @if(count($history) > 0)
        <div class="flex flex-col mt-10">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="border rounded-lg divide-y divide-gray-200">
                  <div class="py-3 px-4">
                  <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                          <tr>
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
                                  Transaksi
                                </span>
                              </div>
                            </th>
            
                            <th scope="col" class="px-6 py-3 text-start">
                              <div class="flex items-center gap-x-2">
                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                  Keterangan
                                </span>
                              </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-end"></th>
                          </tr>
                        </thead>
                        
                        <tbody class="divide-y divide-gray-200">
                          @php ($i = 0)
                          @foreach ($history as $he)
                          @php($i++)
                          <tr>
                            <td class="whitespace-nowrap">
                              <div class="px-6 py-3">
                                <span class="block text-sm text-gray-500">{{ $he->AsetDetail->namaAset }}</span>
                              </div>
                          </td>  
                            <td class="whitespace-nowrap">
                                <div class="px-6 py-3">
                                <span class="block text-sm @if ($he->action === 'Peminjaman')
                                    text-green-600 font-semibold
                                @elseif($he->action === 'Pengembalian')
                                    text-red-600 font-semibold
                                @endif">{{ $he->action }}</span>
                                </div>
                            </td>      
                            <td class="whitespace-nowrap">
                                <div class="px-6 py-3">
                                <span class="block text-sm text-gray-500">{{ $he->keterangan }}</span>
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
                            <span class="font-semibold text-gray-800">{{ count($history) }}</span> results
                          </p>
                        </div>
            
                        <div class="">
                          <div class="inline-flex gap-x-2">
                              @if ($history->previousPageUrl())
                                  <a href="{{ $history->previousPageUrl() }}" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                                      <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                      Prev
                                  </a>
                              @else
                                  <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                      <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                      Prev
                                  </button>
                              @endif
                    
                              @if ($history->nextPageUrl())
                                  <a href="{{ $history->nextPageUrl() }}" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
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
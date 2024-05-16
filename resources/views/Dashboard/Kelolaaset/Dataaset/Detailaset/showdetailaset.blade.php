@extends('dashboard.layouts.main')

@section('container')

<section class="container mt-36 mb-10">
    <div class="bg-white max-w-4xl px-8 py-10 sm:px-8 lg:px-8 lg:py-14 mx-auto mt-24 rounded-t-xl">
        <div class="flex mb-10">
            <a href="{{ route('detailaset.index', $aset->id) }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="text-2xl font-semibold text-gray-900 mr-8">Detail Aset</h1>
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
                    <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400 text-sm">{{ $asetDetail->klasifikasiAset }}</p>
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
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $asetDetail->masaRetensi }}</dd>
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
    </div>
  </section>
  <section class="container -mt-12">
    <div class="bg-white max-w-4xl px-8 py-10 sm:px-8 lg:px-8 lg:py-14 mx-auto mt-24 rounded-t-xl">
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
                                    Nama
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
                                  <span class="block text-sm text-gray-500">{{ $he->user->name }}</span>
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
  </section>  


@endsection
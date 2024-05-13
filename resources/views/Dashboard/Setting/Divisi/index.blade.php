@extends('dashboard.setting.index')

@section('setting')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2">
       <div class="bg-white w-auto rounded-b-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
         <div class="md:flex justify-between items-center">
            <div>
              <h1 class="text-xl font-semibold text-gray-800">Divisi</h1>
              <p class="text-sm text-gray-600">Create/Detail/Edit/Delete</p>
            </div>
            <div class="mt-4 md:mt-0">
                  <div class="inline-flex gap-x-2">
                    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-[#00C74F] text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('setting.create.divisi') }}">
                      <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                      Tambah Divisi
                    </a>
                  </div>
                </div>
          </div>
          <div class="flex flex-col mt-10">
              <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                  <div class="border rounded-lg divide-y divide-gray-200">
                    <div class="py-3 px-4">
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
                    </div>
                    @if(count($divisi) > 0)
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
                                  kode Divisi
                                </span>
                              </div>
                            </th>
                    
                            <th scope="col" class="px-6 py-3 text-start">
                              <div class="flex items-center gap-x-2">
                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                  Nama Divisi
                                </span>
                              </div>
                            </th>
                    
                            <th scope="col" class="px-6 py-3 text-start">
                              <div class="flex items-center gap-x-2">
                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                  Action
                                </span>
                              </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-end"></th>
                          </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                          @php ($i = 0)
                          @foreach ($divisi as $di)
                          @php($i++)
                          <tr>
                            <td class="whitespace-nowrap">
                              <div class="px-6 py-3">
                                <span class="text-sm text-gray-500" style="max-width: 150px;">{{ $i }}</span>
                              </div>
                            </td>
                            <td class="whitespace-nowrap">
                              <div class="px-6 py-3">
                                <span class="text-sm text-gray-500" style="max-width: 150px;">{{ $di->kodeDivisi }}</span>
                              </div>
                            </td>
                            <td class="whitespace-nowrap">
                             <div class="px-6 py-3">
                               <span class="text-sm text-gray-500" style="max-width: 150px;">{{ $di->namaDivisi }}</span>
                             </div>
                           </td>
                          </td>
                            <td class="whitespace-nowrap">
                              <div class="px-6 py-1.5">
                                <a class="inline-flex items-center gap-x-1 text-sm text-green-500 hover:text-green-800 disabled:opacity-50 decoration-2 hover:underline font-medium" href="{{ route('setting.edit.divisi', $di->id) }}">
                                  Edit
                                </a>
                                <a class="inline-flex items-center gap-x-1 text-sm text-red-500 hover:text-red-800 decoration-2 hover:underline font-medium" href="{{ route('setting.delete.divisi', $di->id) }}">
                                  Delete
                                </a>
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
                          Belum ada Divisi yang tersedia.
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

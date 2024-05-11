@extends('dashboard.layouts.main')

@section('container')


<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto mt-24">
  <div class="bg-white w-auto rounded-b-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
      <div class="md:flex justify-between items-center">
        <div>
          <h1 class="text-xl font-semibold text-gray-800">Peminjaman</h1>
          <p class="text-sm text-gray-600">Create/Detail/Edit/Delete</p>
        </div>
        <div class="mt-4 md:mt-0">
              <div class="inline-flex gap-x-2">
                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-[#00C74F] text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('peminjaman.create') }}">
                  <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                  Tambah Peminjaman
                </a>
              </div>
            </div>
      </div>
      <div class="flex flex-col mt-10">
          <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
              <div class="border rounded-lg divide-y divide-gray-200">
                <div class="py-3 px-4">
                  <nav class="bg-white text-sm font-medium text-black ring-1 ring-gray-900 ring-opacity-5 shadow-sm shadow-gray-100 -mt-px" aria-label="Jump links">
                    <div class="max-w-7xl snap-x w-full flex items-center overflow-x-auto mx-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
                      <div class="snap-center shrink-0 pe-5 sm:pe-8 sm:last-pe-0">
                        <a class="inline-flex items-center gap-x-2 hover:text-gray-500 <?php echo Request::is('peminjaman/data peminjaman') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>" href="{{ route('peminjaman.datapeminjaman') }}">Peminjaman</a>
                      </div>
                      <div class="snap-center shrink-0 pe-5 sm:pe-8 sm:last:pe-0">
                        <a class="inline-flex items-center gap-x-2 hover:text-gray-500 <?php echo Request::is('peminjaman/history') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>" href="{{ route('peminjaman.history') }}">History</a>
                      </div>
                    </div>
                  </nav>
                </div>
                  @yield('peminjaman')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
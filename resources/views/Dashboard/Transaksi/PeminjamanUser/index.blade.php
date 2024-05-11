@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10">
    <div class="bg-white w-auto rounded-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="flex justify-between items-center">
          <div>
            <h1 class="text-xl font-bold text-gray-800">Peminjaman</h1>
            <p class="font-sans text-sm text-slate-400">Create/Detail/Edit/Delete</p>
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
                          <a class="inline-flex items-center gap-x-2 hover:text-gray-500 <?php echo Request::is('peminjaman/user/data peminjaman') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>" href="{{ route('peminjaman.datapeminjaman.user') }}">Peminjaman</a>
                        </div>
                        <div class="snap-center shrink-0 pe-5 sm:pe-8 sm:last:pe-0">
                          <a class="inline-flex items-center gap-x-2 hover:text-gray-500 <?php echo Request::is('peminjaman/user/history') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>" href="{{ route('peminjaman.history.user') }}">History</a>
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

@endsection
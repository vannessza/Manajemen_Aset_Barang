@extends('dashboard.setting.index')

@section('setting')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2">
       <div class="bg-white w-auto rounded-b-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">

        <div class="flex p-6">
            <a href="{{ route('setting.index.notification') }}">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M32 15H3.41l8.29-8.29-1.41-1.42-10 10a1 1 0 0 0 0 1.41l10 10 1.41-1.41L3.41 17H32z" data-name="4-Arrow Left"/></svg>
            </a>
           
            <div class="m-auto">
                <h1 class="text-lg font-semibold text-gray-900">Create Notification</h1>
            </div>
            
        </div>
        <div class="mx-auto block max-w-xl rounded-lg bg-white p-6 shadow-4">
            <form action="{{ route('setting.store.notification') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                        <select id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option value="">Pilih Nama</option>
                            @foreach ($admin as $ad)
                                <option value="{{ $ad->id }}">{{ $ad->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="inline-block w-full rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong" data-twe-ripple-init data-twe-ripple-color="light">
                    Create
                </button>
            </form>
        </div>

       </div>
    </div>
 </div>
@endsection

@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-36 mb-10 lg:flex justify-center">
    <div class="bg-white w-auto h-96 rounded-xl flex justify-center items-center shadow-xl max-w-md mx-auto">
        <div class="p-4 text-center">
            <h1 class="font-semibold text-xl mb-8">Selamat Datang Super Admin</h1>
            <div class="flex flex-wrap justify-center gap-4 font-bold">
                <a href="{{ route('dataaset.index') }}" class="flex items-center justify-center py-4 px-8 bg-[#F8DAA1] text-[#FFA800] rounded-xl hover:bg-[#F1B94D] hover:text-[#634100] transition duration-300"><div class="w-[100px] h-[100px] py-10">Data Aset</div></a>
                <a href="{{ route('peminjaman.index') }}" class="flex items-center justify-center py-4 px-8 bg-[#B0BAF0] text-[#3051FF] rounded-xl hover:bg-[#5872F9] hover:text-[#000F5B] transition duration-300"><div class="w-[100px] h-[100px] py-7">Data Peminjaman</div></a>
                <a href="{{ route('pengembalian.index') }}" class="flex items-center justify-center py-4 px-8 bg-[#BAF9EE] text-[#00FFF0] rounded-xl hover:bg-[#6AFFE5] hover:text-[#00534E] transition duration-300"><div class="w-[100px] h-[100px] py-7">Data Pengembalian</div></a>
                <a href="{{ route('user.index') }}" class="flex items-center justify-center py-4 px-8 bg-[#F9BABA] text-[#FF0F00] rounded-xl hover:bg-[#FB6565] hover:text-[#640802] transition duration-300"><div class="w-[100px] h-[100px] py-10">Data User</div></a>
            </div>
        </div>
    </div>
    <div class="mt-10 lg:mt-0">
        <div class="lg:flex justify-between">
            <div>
                <a href="{{ route('admin.index') }}">
                    <div class="bg-white w-full lg:w-96 h-[176px] rounded-xl shadow-xl max-w-md mx-auto">
                        <div class="flex justify-between">
                            <div class="pt-5 pl-8">
                                <h1 class="font-bold text-lg text-[#FFA800]">Jumlah Admin</h1>
                                <p class="font-semibold text-sm text-[#494646]">Daftar Jumlah Admin</p>
                            </div>
                            <div class="">
                                <h1 class="py-3 px-4 text-[20px] bg-[#ECD391] text-[#FFA800] mr-8 mt-5">{{ $jumlahAdmin }}</h1>
                            </div>
                        </div>
                    
                    </div>
                </a>
            </div>
            <div class="mt-10 lg:mt-0 lg:ml-4">
                <a href="{{ route('peminjaman.index') }}">
                    <div class="bg-white w-full lg:w-96 h-[176px] rounded-xl shadow-xl max-w-md mx-auto">
                        <div class="flex justify-between">
                            <div class="pt-5 pl-8">
                                <h1 class="font-bold text-lg text-[#3051FF]">Jumlah Peminjaman</h1>
                                <p class="font-semibold text-sm text-[#494646]">Daftar Jumlah Peminjaman</p>
                            </div>
                            <div class="">
                                <h1 class="py-3 px-4 text-[20px] bg-[#9BB6FB] text-[#3051FF] mr-8 mt-5">{{ $jumlahPeminjaman }}</h1>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="lg:flex justify-between mt-10">
            <div class="mt-10 lg:mt-0">
                <a href="{{ route('pengembalian.index') }}">
                    <div class="bg-white w-full lg:w-96  h-[176px] rounded-xl shadow-xl max-w-md mx-auto">
                        <div class="flex justify-between">
                            <div class="pt-5 pl-8">
                                <h1 class="font-bold text-lg text-[#00FFF0]">Jumlah Pengembalian</h1>
                                <p class="font-semibold text-sm text-[#494646]">Daftar Jumlah Pengembalian</p>
                            </div>
                            <div class="">
                                <h1 class="py-3 px-4 text-[20px] bg-[#A4F4E6] text-[#00FFF0] mr-8 mt-5">{{ $jumlahPengembalian }}</h1>
                            </div>
                        </div>
                    
                    </div>
                </a>
            </div>
            <div class="mt-10 lg:mt-0 lg:ml-4">
                <a href="{{ route('user.index') }}">
                    <div class="bg-white w-full lg:w-96  h-[176px] rounded-xl shadow-xl max-w-md mx-auto">
                        <div class="flex justify-between">
                            <div class="pt-5 pl-8">
                                <h1 class="font-bold text-lg text-[#FF0F00]">Jumlah User</h1>
                                <p class="font-semibold text-sm text-[#494646]">Daftar Jumlah User</p>
                            </div>
                            <div class="">
                                <h1 class="py-3 px-4 text-[20px] bg-[#F9BABA] text-[#FF0F00] mr-8 mt-5">{{ $jumlahUser }}</h1>
                            </div>
                        </div>
                    
                    </div>
                </a>
            </div>
        </div>
        <div class="lg:flex justify-between mt-10">
            <div class="mt-10 lg:mt-0">
                <a href="{{ route('admin.index') }}">
                    <div class="bg-white w-full lg:w-96 h-[176px] rounded-xl shadow-xl max-w-md mx-auto">
                        <div class="flex justify-between">
                            <div class="pt-5 pl-8">
                                <h1 class="font-bold text-lg text-[#24B400]">Jumlah Admin</h1>
                                <p class="font-semibold text-sm text-[#494646]">Daftar Jumlah Admin</p>
                            </div>
                            <div class="">
                                <h1 class="py-3 px-4 text-[20px] bg-[#A9FF65] text-[#24B400] mr-8 mt-5">{{ $jumlahAdmin }}</h1>
                            </div>
                        </div>
                    
                    </div>
                </a>
            </div>
            <div class="mt-10 lg:mt-0 lg:ml-4">
                <a href="{{ route('request.index') }}">
                    <div class="bg-white w-full lg:w-96 h-[176px] rounded-xl shadow-xl max-w-md mx-auto">
                        <div class="flex justify-between">
                            <div class="pt-5 pl-8">
                                <h1 class="font-bold text-lg text-[#3E3E3E]">Jumlah Request Aset</h1>
                                <p class="font-semibold text-sm text-[#494646]">Daftar Jumlah Request Aset</p>
                            </div>
                            <div class="">
                                <h1 class="py-3 px-4 text-[20px] bg-[#969696] text-[#2C2C2C] mr-8 mt-5">{{ $jumlahRequestProses }}</h1>
                            </div>
                        </div>
                    
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
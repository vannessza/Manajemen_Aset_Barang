@extends('dashboard.layouts.main')

@section('container')
@if(Auth::user()->hasRole('adminsuper'))
<div class="container mt-36 mb-10 xl:flex justify-center">
    <div class="bg-white w-auto h-96 rounded-xl flex justify-center items-center shadow-xl max-w-md mx-auto">
        <div class="p-4 text-center">
            <h1 class="font-semibold text-xl mb-8">Selamat Datang {{ $pengguna->name }}</h1>
            <div class="flex flex-wrap justify-center gap-4 font-bold">
                <a href="{{ route('dataaset.index') }}" class="flex items-center justify-center md:py-4 md:px-8 py-2 px-4 bg-[#F8DAA1] text-[#FFA800] rounded-xl hover:bg-[#F1B94D] hover:text-[#634100] transition duration-300"><div class="w-[100px] h-[100px] py-10">Data Aset</div></a>
                <a href="{{ route('peminjaman.datapeminjaman') }}" class="flex items-center justify-center md:py-4 md:px-8 py-2 px-4 bg-[#B0BAF0] text-[#3051FF] rounded-xl hover:bg-[#5872F9] hover:text-[#000F5B] transition duration-300"><div class="w-[100px] h-[100px] py-7">Data Peminjaman</div></a>
                <a href="{{ route('pengembalian.datapengembalian') }}" class="flex items-center justify-center md:py-4 md:px-8 py-2 px-4 bg-[#BAF9EE] text-[#00FFF0] rounded-xl hover:bg-[#6AFFE5] hover:text-[#00534E] transition duration-300"><div class="w-[100px] h-[100px] py-7">Data Pengembalian</div></a>
                <a href="{{ route('user.index') }}" class="flex items-center justify-center md:py-4 md:px-8 py-2 px-4 bg-[#F9BABA] text-[#FF0F00] rounded-xl hover:bg-[#FB6565] hover:text-[#640802] transition duration-300"><div class="w-[100px] h-[100px] py-10">Data User</div></a>
            </div>
        </div>
    </div>
    <div class="mt-10 lg:mt-10 xl:mt-0 mx-auto lg:px-20 xl:px-0">
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
                <a href="{{ route('peminjaman.datapeminjaman') }}">
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
                <a href="{{ route('pengembalian.datapengembalian') }}">
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
@endif
@if(Auth::user()->hasRole('user'))
<div class="container mt-36 mb-10 xl:flex justify-center">
    <div class="bg-white w-auto h-96 rounded-xl flex justify-center items-center shadow-xl max-w-md mx-auto">
        <div class="p-4 text-center">
            <h1 class="font-semibold text-xl mb-8">Selamat Datang {{ $pengguna->name }}</h1>
            <div class="flex flex-wrap justify-center gap-4 font-bold">
                <a href="{{ route('aset.index') }}" class="flex items-center justify-center md:py-4 md:px-8 py-2 px-4 bg-[#F8DAA1] text-[#FFA800] rounded-xl hover:bg-[#F1B94D] hover:text-[#634100] transition duration-300"><div class="w-[100px] h-[100px] py-10">Aset</div></a>
                <a href="{{ route('peminjaman.datapeminjaman.user') }}" class="flex items-center justify-center md:py-4 md:px-8 py-2 px-4 bg-[#B0BAF0] text-[#3051FF] rounded-xl hover:bg-[#5872F9] hover:text-[#000F5B] transition duration-300"><div class="w-[100px] h-[100px] py-7">Aset Peminjaman</div></a>
                <a href="{{ route('pengembalian.datapengembalian.user') }}" class="flex items-center justify-center md:py-4 md:px-8 py-2 px-4 bg-[#BAF9EE] text-[#00FFF0] rounded-xl hover:bg-[#6AFFE5] hover:text-[#00534E] transition duration-300"><div class="w-[100px] h-[100px] py-7">Aset Pengembalian</div></a>
                <a href="{{ route('profile.index') }}" class="flex items-center justify-center md:py-4 md:px-8 py-2 px-4 bg-[#F9BABA] text-[#FF0F00] rounded-xl hover:bg-[#FB6565] hover:text-[#640802] transition duration-300"><div class="w-[100px] h-[100px] py-10">Profile</div></a>
            </div>
        </div>
    </div>
    <div class="mt-10 lg:mt-10 xl:mt-0 mx-auto lg:px-20 xl:px-0">
        <div class="lg:flex justify-between">
            <div>
                <a href="{{ route('aset.index') }}">
                    <div class="bg-white w-full lg:w-96 h-[176px] rounded-xl shadow-xl max-w-md mx-auto">
                        <div class="flex justify-between">
                            <div class="pt-5 pl-8">
                                <h1 class="font-bold text-lg text-[#FFA800]">Jumlah Barang</h1>
                                <p class="font-semibold text-sm text-[#494646]">Daftar Jumlah Barang</p>
                            </div>
                            <div class="">
                                <h1 class="py-3 px-4 text-[20px] bg-[#ECD391] text-[#FFA800] mr-8 mt-5">{{ $jumlahAsetDetail }}</h1>
                            </div>
                        </div>
                    
                    </div>
                </a>
            </div>
            <div class="mt-10 lg:mt-0 lg:ml-4">
                <a href="{{ route('peminjaman.datapeminjaman.user') }}">
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
                <a href="{{ route('pengembalian.datapengembalian.user') }}">
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
        </div>
    </div>
</div>
@endif
@if(Auth::user()->hasRole('admin'))
<div class="container mt-36 mb-10 xl:flex justify-center">
    <div class="bg-white w-auto h-96 rounded-xl flex justify-center items-center shadow-xl max-w-md mx-auto">
        <div class="p-4 text-center">
            <h1 class="font-semibold text-xl mb-8">Selamat Datang {{ $pengguna->name }}</h1>
            <div class="flex flex-wrap justify-center gap-4 font-bold">
                <a href="{{ route('dataaset.index') }}" class="flex items-center justify-center md:py-4 md:px-8 py-2 px-4 bg-[#F8DAA1] text-[#FFA800] rounded-xl hover:bg-[#F1B94D] hover:text-[#634100] transition duration-300"><div class="w-[100px] h-[100px] py-10">Data Aset</div></a>
                <a href="{{ route('peminjaman.datapeminjaman') }}" class="flex items-center justify-center md:py-4 md:px-8 py-2 px-4 bg-[#B0BAF0] text-[#3051FF] rounded-xl hover:bg-[#5872F9] hover:text-[#000F5B] transition duration-300"><div class="w-[100px] h-[100px] py-7">Data Peminjaman</div></a>
                <a href="{{ route('pengembalian.datapengembalian') }}" class="flex items-center justify-center md:py-4 md:px-8 py-2 px-4 bg-[#BAF9EE] text-[#00FFF0] rounded-xl hover:bg-[#6AFFE5] hover:text-[#00534E] transition duration-300"><div class="w-[100px] h-[100px] py-7">Data Pengembalian</div></a>
                <a href="{{ route('user.index') }}" class="flex items-center justify-center md:py-4 md:px-8 py-2 px-4 bg-[#F9BABA] text-[#FF0F00] rounded-xl hover:bg-[#FB6565] hover:text-[#640802] transition duration-300"><div class="w-[100px] h-[100px] py-10">Data User</div></a>
            </div>
        </div>
    </div>
    <div class="mt-10 lg:mt-10 xl:mt-0 mx-auto lg:px-20 xl:px-0">
        <div class="lg:flex justify-between">
            <div>
                <a href="{{ route('admin.index') }}">
                    <div class="bg-white w-full lg:w-96 h-[176px] rounded-xl shadow-xl max-w-md mx-auto">
                        <div class="flex justify-between">
                            <div class="pt-5 pl-8">
                                <h1 class="font-bold text-lg text-[#FFA800]">Jumlah Barang</h1>
                                <p class="font-semibold text-sm text-[#494646]">Daftar Jumlah Barang</p>
                            </div>
                            <div class="">
                                <h1 class="py-3 px-4 text-[20px] bg-[#ECD391] text-[#FFA800] mr-8 mt-5">{{ $jumlahAsetDetail }}</h1>
                            </div>
                        </div>
                    
                    </div>
                </a>
            </div>
            <div class="mt-10 lg:mt-0 lg:ml-4">
                <a href="{{ route('peminjaman.datapeminjaman') }}">
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
                <a href="{{ route('pengembalian.datapengembalian') }}">
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
        <div class=" mt-10">
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
@endif
@endsection
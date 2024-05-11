<Header class="bg-white absolute top-0 left-0 w-full flex
items-center z-10 h-[100px]">
 <div class="container">
    <div class="flex justify-between items-center relative">
        <div class="hs-dropdown relative block lg:hidden" data-hs-dropdown-placement="bottom-right">
          <button id="dropdown4" type="button" class="hs-dropdown-toggle h-[2.375rem] flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
            <img class="inline-block size-[38px] rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Image Description">
          </button>

          <div id="dropdown-menu4" class="absolute hidden min-w-60 z-10 bg-white shadow-md rounded-lg p-2" aria-labelledby="hs-dropdown-with-header">
            <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg">
              <p class="text-sm text-gray-500">Signed in as</p>
              <p class="text-sm font-medium text-gray-800">{{ $pengguna->email }}</p>
            </div>
            <div class="mt-2 py-2 first:pt-0 last:pb-0">
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="#">
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                Profile
              </a>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="#">
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                Setting
              </a>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="{{ route('logout') }}">
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="M12 12v9"/><path d="m8 17 4 4 4-4"/></svg>
                logout
              </a>
            </div>
          </div>
        </div>
        <div class="px-4">
            <a href="/"><img src="{{ asset('image/logo/logo1.png') }}" class="w-20 py-6" alt=""></a>
        </div>
        <div class="flex items-center px-4">
            <Button id="menuline" name="menuline" type="button" 
            class="block absolute right-4 lg:hidden">
                <span class="menuline bg-[#008d8d] transition duration-300
                ease-in-out origin-top-left"></span>
                <span class="menuline bg-[#fdc330] transition duration-300
                ease-in-out"></span>
                <span class="menuline bg-[#008d8d] transition duration-300
                ease-in-out origin-bottom-left"></span>
            </Button>
            

            <nav id= "nav-menu" class="hidden absolute py-full bg-slate-400
            rounded-lg w-full right-1 top-full lg:block lg:static
            lg:bg-transparent lg:max-w-full shadow-xl lg:shadow-none">

                <ul class="block lg:flex font-bold my-4">
                    
                    <li class="group">
                        <a href="/dashboard" class="text-base font- py-2 mx-8
                        flex group-hover:text-[#008d8d]    <?php echo Request::is('dashboard') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">Dashboard</a>
                    </li>
                    @if(Auth::user()->hasRole('user'))
                    <li class="group">
                      <a href="{{ route('aset.index') }}" class="text-base font- py-2 mx-8
                      flex group-hover:text-[#008d8d]    <?php echo Request::is('aset') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">Aset</a>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('user'))
                    <li class="group">
                      <a href="{{ route('peminjaman.index.user') }}" class="text-base font- py-2 mx-8
                      flex group-hover:text-[#008d8d]    <?php echo Request::is('peminjaman/user') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">Peminjaman</a>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('user'))
                    <li class="group">
                      <a href="{{ route('pengembalian.index.user') }}" class="text-base font- py-2 mx-8
                      flex group-hover:text-[#008d8d]    <?php echo Request::is('pengembalian/user') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">Pengembalian</a>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('adminsuper') || Auth::user()->hasRole('admin'))
                    <li class="group relative">
                        <button id="dropdown" class="text-base font-sans py-2 mx-8 flex justify-between w-1/2 group-hover:text-[#008d8d] <?php echo Request::is('kelola aset') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">
                                 Aset
                                <span class="mr-2 lg:ml-2 transition duration-300" id="dropdown-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M12 17.414 3.293 8.707l1.414-1.414L12 14.586l7.293-7.293 1.414 1.414L12 17.414z"/></svg>
                                </span>
                             
                        </button>
                        <div id="dropdown-menu" class="lg:absolute bg-white  rounded-b-md ml-4 p-4 shadow-xl w-1/2 lg:w-40 hidden mb-2">
                            <ul class="space-y-2">
                                <li><a href="{{ route('aset.index') }}" class="flex p-2 font-medium rounded-md hover:text-[#008d8d] <?php echo Request::is('aset') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">Aset</a></li>
                                <li><a href="{{ route('dataaset.index') }}" class="flex p-2 font-medium rounded-md hover:text-[#008d8d] <?php echo Request::is('data aset') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">Data Aset</a></li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('adminsuper') || Auth::user()->hasRole('admin'))
                    <li class="group relative">
                        <button id="dropdown2" class="text-base font-sans py-2 mx-8 flex justify-between w-1/2 group-hover:text-[#008d8d] <?php echo Request::is('kelola aset') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">
                            Transaksi
                            <span class="mr-2 lg:ml-2 transition duration-300" id="dropdown-icon2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M12 17.414 3.293 8.707l1.414-1.414L12 14.586l7.293-7.293 1.414 1.414L12 17.414z"/></svg>
                            </span>
                        </button>
                        <div id="dropdown-menu2" class="lg:absolute bg-white  rounded-b-md ml-4 p-4 shadow-xl w-1/2 lg:w-40 hidden mb-2">
                            <ul class="space-y-2">
                                <li><a href="{{ route('request.index')}}" class="flex p-2 font-medium rounded-md hover:text-[#008d8d]">Request</a></li>
                                <li><a href="{{ route('peminjaman.index') }}" class="flex p-2 font-medium rounded-md hover:text-[#008d8d]">Peminjaman</a></li>
                                <li><a href="{{ route('pengembalian.index') }}" class="flex p-2 font-medium rounded-md hover:text-[#008d8d]">Pengembalian</a></li>
                                <li><a href="{{ route('penghancuran.index') }}" class="flex p-2 font-medium rounded-md hover:text-[#008d8d]">Penghancuran</a></li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('adminsuper'))
                    <li class="group relative">
                        <button id="dropdown3" class="text-base font-sans py-2 mx-8 flex justify-between w-1/2 group-hover:text-[#008d8d] <?php echo Request::is('kelola aset') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">
                            Akun
                            <span class="mr-2 lg:ml-2 transition duration-300" id="dropdown-icon3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M12 17.414 3.293 8.707l1.414-1.414L12 14.586l7.293-7.293 1.414 1.414L12 17.414z"/></svg>
                            </span>
                        </button>
                        <div id="dropdown-menu3" class="lg:absolute bg-white  rounded-b-md ml-4 p-4 shadow-xl w-1/2 lg:w-40 hidden">
                            <ul class="space-y-2">
                                <li><a href="{{ route('user.index') }}" class="flex p-2 font-medium rounded-md hover:text-[#008d8d]">User</a></li>
                                <li><a href="{{ route('admin.index') }}" class="flex p-2 font-medium rounded-md hover:text-[#008d8d]">Admin</a></li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('admin'))
                    <li class="group relative">
                        <a href="{{ route('user.index') }}" class="text-base font- py-2 mx-8
                        flex group-hover:text-[#008d8d]    <?php echo Request::is('user') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">user</a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
        <div class="hs-dropdown relative hidden lg:block" data-hs-dropdown-placement="bottom-right">
            <button id="dropdown4" type="button" class="hs-dropdown-toggle h-[2.375rem] flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
              <p>Hallo {{ $pengguna->name }}</p>
              <span class="transition duration-300" id="dropdown-icon4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="gray"><path d="M12 17.414 3.293 8.707l1.414-1.414L12 14.586l7.293-7.293 1.414 1.414L12 17.414z"/></svg>
              </span>
              <img class="inline-block size-[38px] rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Image Description">
            </button>
  
            <div id="dropdown-menu4" class="lg:absolute hidden min-w-60 z-10 bg-white shadow-md rounded-lg p-2" aria-labelledby="hs-dropdown-with-header">
              <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg">
                <p class="text-sm text-gray-500">Signed in as</p>
                <p class="text-sm font-medium text-gray-800">{{ $pengguna->email }}</p>
              </div>
              <div class="mt-2 py-2 first:pt-0 last:pb-0">
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="#">
                  <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                  Profile
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="#">
                  <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                  Setting
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="{{ route('logout') }}">
                  <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="M12 12v9"/><path d="m8 17 4 4 4-4"/></svg>
                  logout
                </a>
              </div>
            </div>
          </div>
    </div>
 </div>
</Header>



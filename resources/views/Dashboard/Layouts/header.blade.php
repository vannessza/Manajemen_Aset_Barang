<Header class="bg-white absolute top-0 left-0 w-full flex
items-center z-10 h-[100px]">
 <div class="container">
    <div class="flex justify-between items-center relative">
        <div class="hs-dropdown relative block lg:hidden" data-hs-dropdown-placement="bottom-right">
          <button id="dropdown5" type="button" class="hs-dropdown-toggle h-[2.375rem] flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
              @if ($pengguna->profile->image)
                  <img src="{{ asset('storage/'. $pengguna->profile->image) }}" alt="User Image" class="inline-block h-10 w-10 rounded-full">
              @else
                  <img src="{{ asset('image/icon/User.png') }}" alt="Default Image" class="inline-block h-10 w-10 rounded-full">
              @endif
          </button>

          <div id="dropdown-menu5" class="absolute hidden min-w-60 z-10 bg-white shadow-md rounded-lg p-2" aria-labelledby="hs-dropdown-with-header">
            <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg">
              <p class="text-sm text-gray-500">Signed in as</p>
              <p class="text-sm font-medium text-gray-800">{{ $pengguna->email }}</p>
            </div>
            <div class="mt-2 py-2 first:pt-0 last:pb-0">
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="{{ route('profile.index') }}">
                <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                </svg>                
                Profile
              </a>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="{{ route('setting.index') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0175 19C10.6601 19 10.3552 18.7347 10.297 18.373C10.2434 18.0804 10.038 17.8413 9.76171 17.75C9.53658 17.6707 9.31645 17.5772 9.10261 17.47C8.84815 17.3365 8.54289 17.3565 8.30701 17.522C8.02156 17.7325 7.62943 17.6999 7.38076 17.445L6.41356 16.453C6.15326 16.186 6.11944 15.7651 6.33361 15.458C6.49878 15.2105 6.52257 14.8914 6.39601 14.621C6.31262 14.4332 6.23906 14.2409 6.17566 14.045C6.08485 13.7363 5.8342 13.5051 5.52533 13.445C5.15287 13.384 4.8779 13.0559 4.87501 12.669V11.428C4.87303 10.9821 5.18705 10.6007 5.61601 10.528C5.94143 10.4645 6.21316 10.2359 6.33751 9.921C6.37456 9.83233 6.41356 9.74433 6.45451 9.657C6.61989 9.33044 6.59705 8.93711 6.39503 8.633C6.1424 8.27288 6.18119 7.77809 6.48668 7.464L7.19746 6.735C7.54802 6.37532 8.1009 6.32877 8.50396 6.625L8.52638 6.641C8.82735 6.84876 9.21033 6.88639 9.54428 6.741C9.90155 6.60911 10.1649 6.29424 10.2375 5.912L10.2473 5.878C10.3275 5.37197 10.7536 5.00021 11.2535 5H12.1115C12.6248 4.99976 13.0629 5.38057 13.1469 5.9L13.1625 5.97C13.2314 6.33617 13.4811 6.63922 13.8216 6.77C14.1498 6.91447 14.5272 6.87674 14.822 6.67L14.8707 6.634C15.2842 6.32834 15.8528 6.37535 16.2133 6.745L16.8675 7.417C17.1954 7.75516 17.2366 8.28693 16.965 8.674C16.7522 8.99752 16.7251 9.41325 16.8938 9.763L16.9358 9.863C17.0724 10.2045 17.3681 10.452 17.7216 10.521C18.1837 10.5983 18.5235 11.0069 18.525 11.487V12.6C18.5249 13.0234 18.2263 13.3846 17.8191 13.454C17.4842 13.5199 17.2114 13.7686 17.1083 14.102C17.0628 14.2353 17.0121 14.3687 16.9562 14.502C16.8261 14.795 16.855 15.1364 17.0323 15.402C17.2662 15.7358 17.2299 16.1943 16.9465 16.485L16.0388 17.417C15.7792 17.6832 15.3698 17.7175 15.0716 17.498C14.8226 17.3235 14.5001 17.3043 14.2331 17.448C14.0428 17.5447 13.8475 17.6305 13.6481 17.705C13.3692 17.8037 13.1636 18.0485 13.1099 18.346C13.053 18.7203 12.7401 18.9972 12.3708 19H11.0175Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9747 12C13.9747 13.2885 12.9563 14.333 11.7 14.333C10.4437 14.333 9.42533 13.2885 9.42533 12C9.42533 10.7115 10.4437 9.66699 11.7 9.66699C12.9563 9.66699 13.9747 10.7115 13.9747 12Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                Setting
              </a>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="{{ route('logout') }}">
                <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
                </svg>                
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
              @if ($pengguna->profile->image)
              <img src="{{ asset('storage/'. $pengguna->profile->image) }}" alt="User Image" class="inline-block h-10 w-10 rounded-full">
              @else
                  <img src="{{ asset('image/icon/User.png') }}" alt="Default Image" class="inline-block h-10 w-10 rounded-full">
              @endif
            </button>
  
            <div id="dropdown-menu4" class="absolute hidden min-w-60 z-10 bg-white shadow-md rounded-lg p-2" aria-labelledby="hs-dropdown-with-header">
              <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg">
                <p class="text-sm text-gray-500">Signed in as</p>
                <p class="text-sm font-medium text-gray-800">{{ $pengguna->email }}</p>
              </div>
              <div class="mt-2 py-2 first:pt-0 last:pb-0">
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="{{ route('profile.index') }}">
                  <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                  </svg>                
                  Profile
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="{{ route('setting.index') }}">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0175 19C10.6601 19 10.3552 18.7347 10.297 18.373C10.2434 18.0804 10.038 17.8413 9.76171 17.75C9.53658 17.6707 9.31645 17.5772 9.10261 17.47C8.84815 17.3365 8.54289 17.3565 8.30701 17.522C8.02156 17.7325 7.62943 17.6999 7.38076 17.445L6.41356 16.453C6.15326 16.186 6.11944 15.7651 6.33361 15.458C6.49878 15.2105 6.52257 14.8914 6.39601 14.621C6.31262 14.4332 6.23906 14.2409 6.17566 14.045C6.08485 13.7363 5.8342 13.5051 5.52533 13.445C5.15287 13.384 4.8779 13.0559 4.87501 12.669V11.428C4.87303 10.9821 5.18705 10.6007 5.61601 10.528C5.94143 10.4645 6.21316 10.2359 6.33751 9.921C6.37456 9.83233 6.41356 9.74433 6.45451 9.657C6.61989 9.33044 6.59705 8.93711 6.39503 8.633C6.1424 8.27288 6.18119 7.77809 6.48668 7.464L7.19746 6.735C7.54802 6.37532 8.1009 6.32877 8.50396 6.625L8.52638 6.641C8.82735 6.84876 9.21033 6.88639 9.54428 6.741C9.90155 6.60911 10.1649 6.29424 10.2375 5.912L10.2473 5.878C10.3275 5.37197 10.7536 5.00021 11.2535 5H12.1115C12.6248 4.99976 13.0629 5.38057 13.1469 5.9L13.1625 5.97C13.2314 6.33617 13.4811 6.63922 13.8216 6.77C14.1498 6.91447 14.5272 6.87674 14.822 6.67L14.8707 6.634C15.2842 6.32834 15.8528 6.37535 16.2133 6.745L16.8675 7.417C17.1954 7.75516 17.2366 8.28693 16.965 8.674C16.7522 8.99752 16.7251 9.41325 16.8938 9.763L16.9358 9.863C17.0724 10.2045 17.3681 10.452 17.7216 10.521C18.1837 10.5983 18.5235 11.0069 18.525 11.487V12.6C18.5249 13.0234 18.2263 13.3846 17.8191 13.454C17.4842 13.5199 17.2114 13.7686 17.1083 14.102C17.0628 14.2353 17.0121 14.3687 16.9562 14.502C16.8261 14.795 16.855 15.1364 17.0323 15.402C17.2662 15.7358 17.2299 16.1943 16.9465 16.485L16.0388 17.417C15.7792 17.6832 15.3698 17.7175 15.0716 17.498C14.8226 17.3235 14.5001 17.3043 14.2331 17.448C14.0428 17.5447 13.8475 17.6305 13.6481 17.705C13.3692 17.8037 13.1636 18.0485 13.1099 18.346C13.053 18.7203 12.7401 18.9972 12.3708 19H11.0175Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9747 12C13.9747 13.2885 12.9563 14.333 11.7 14.333C10.4437 14.333 9.42533 13.2885 9.42533 12C9.42533 10.7115 10.4437 9.66699 11.7 9.66699C12.9563 9.66699 13.9747 10.7115 13.9747 12Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                  Setting
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="{{ route('logout') }}">
                  <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
                  </svg>                
                  logout
                </a>
              </div>
            </div>
          </div>
    </div>
 </div>
</Header>



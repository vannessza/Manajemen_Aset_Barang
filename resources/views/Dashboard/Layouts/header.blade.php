<Header class="bg-white absolute top-0 left-0 w-full flex
items-center z-10 h-[100px]">
 <div class="container">
    <div class="flex items-center relative">
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
            

            <nav id= "nav-menu" class="hidden absolute py-full bg-[#fdc330]
            rounded-lg w-full right-1 top-full lg:block lg:static
            lg:bg-transparent lg:max-w-full shadow-xl lg:shadow-none">

                <ul class="block lg:flex font-bold my-4">
                    
                    <li class="group">
                        <a href="/dashboard" class="text-base py-2 mx-8
                        flex group-hover:text-[#008d8d]  <?php echo Request::is('dashboard') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">Dashboard</a>
                    </li>
                    <li class="group relative">
                        <button id="dropdown" class="text-base py-2 mx-8 flex group-hover:text-[#008d8d] <?php echo Request::is('kelola aset') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">
                                 Kelola Aset
                                <span class="ml-[150px] mr-2 lg:ml-2" id="dropdown-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M12 17.414 3.293 8.707l1.414-1.414L12 14.586l7.293-7.293 1.414 1.414L12 17.414z"/></svg>
                                </span>
                             
                        </button>
                        <div id="dropdown-menu" class="lg:absolute bg-white  rounded-b-md ml-4 p-4 shadow-xl w-[285px] lg:w-40 hidden ">
                            <ul class="space-y-2">
                                <li><a href="{{ route('aset.index') }}" class="flex p-2 font-medium rounded-md hover:text-[#008d8d] <?php echo Request::is('aset') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">Aset</a></li>
                                <li><a href="{{ route('dataaset.index') }}" class="flex p-2 font-medium rounded-md hover:text-[#008d8d] <?php echo Request::is('data aset') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">Data Aset</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="group relative">
                        <button id="dropdown2" class="text-base py-2 mx-8 flex group-hover:text-[#008d8d] <?php echo Request::is('kelola aset') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">
                            Transaksi
                            <span class="ml-[163px] mr-2 lg:ml-2" id="dropdown-icon2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M12 17.414 3.293 8.707l1.414-1.414L12 14.586l7.293-7.293 1.414 1.414L12 17.414z"/></svg>
                            </span>
                        </button>
                        <div id="dropdown-menu2" class="lg:absolute bg-white  rounded-b-md ml-4 p-4 shadow-xl w-[285px] lg:w-40 hidden">
                            <ul class="space-y-2">
                                <li><a href="" class="flex p-2 font-medium rounded-md hover:text-[#008d8d]">Request</a></li>
                                <li><a href="{{ route('peminjaman.index') }}" class="flex p-2 font-medium rounded-md hover:text-[#008d8d]">Peminjaman</a></li>
                                <li><a href="{{ route('pengembalian.index') }}" class="flex p-2 font-medium rounded-md hover:text-[#008d8d]">Pengembalian</a></li>
                                <li><a href="" class="flex p-2 font-medium rounded-md hover:text-[#008d8d]">Penghancuran</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="group relative">
                        <button id="dropdown3" class="text-base py-2 mx-8 flex group-hover:text-[#008d8d] <?php echo Request::is('kelola aset') ? ' text-[#008d8d] lg:border-b-2 lg:border-[#008d8d]' : ''; ?>">
                            Akun
                            <span class="ml-[197px] mr-2 lg:ml-2" id="dropdown-icon3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M12 17.414 3.293 8.707l1.414-1.414L12 14.586l7.293-7.293 1.414 1.414L12 17.414z"/></svg>
                            </span>
                        </button>
                        <div id="dropdown-menu3" class="lg:absolute bg-white  rounded-b-md ml-4 p-4 shadow-xl w-[285px] lg:w-40 hidden">
                            <ul class="space-y-2">
                                <li><a href="" class="flex p-2 font-medium rounded-md hover:text-[#008d8d]">User</a></li>
                                <li><a href="" class="flex p-2 font-medium rounded-md hover:text-[#008d8d]">Admin</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
 </div>
</Header>
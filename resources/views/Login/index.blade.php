<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>
<body class="bg-slate-200">
    <div class="container">
        <div class="w-full px-4 mt-12 md:mt-24 xl:mt-36 self-center mb-36">
            <div class="justify-center items-center bg-white xl:w-[524px] mx-auto my-auto shadow-2xl rounded-xl">
                <div class="p-3">
                    <div class="flex justify-center">
                        <a href="/">
                            <img src="{{ asset('image/logo/logo1.png') }}" class="w-20 pb-6 mx-auto" alt="">
                        </a>
                    </div>
                    <div>
                        <form action="/login" method="post" class="flex flex-col gap-4 px-10">
                            @csrf
                            @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                    <strong class="font-bold">Oops!</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <label for="email">
                                <span class="block font-semibold mb-1 after:content-['*']
                                after:text-pink-500 after:ml-0.5" >Email</span>
                                <input class="p-2 rounded-xl border focus:ring-1
                                focus:outline-none
                                focus:ring-[#fdc330] focus:border-[#fdc330]
                                invalid:text-pink-600
                                invalid:focus:ring-pink-700
                                invalid:focus:border-pink-700 peer w-full" type="email" name="email" id="email" placeholder="Masukan Email">
                                @error('email')
                                    <p class="text-sm m-1 text-red-700">{{ $message }}</p>
                                @enderror
                            </label>
                            <label for="password">
                                <span class="block font-semibold mb-1 after:content-['*']
                                after:text-pink-500 after:ml-0.5" >Password</span>
                                <input class="p-2 rounded-xl border focus:ring-1
                                focus:outline-none
                                focus:ring-[#fdc330] focus:border-[#fdc330]
                                invalid:text-pink-600
                                invalid:focus:ring-pink-700
                                invalid:focus:border-pink-700 peer w-full" type="password" name="password" id="password" placeholder="Masukan Password">
                                @error('password')
                                    <p class="text-sm m-1 text-red-700">{{ $message }}</p>
                                @enderror
                            </label>
                            <div class="flex justify-center pb-3">
                                <button class="bg-[#008d8d] px-5
                                py-2 rounded-full text-white font-semibold
                                font-inter block w-40 xl:w-56 hover:bg-[#006c6c]">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

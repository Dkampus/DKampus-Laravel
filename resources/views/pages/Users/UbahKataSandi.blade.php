@extends('layouts.Root')
@section('content')
    <header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
        <a href="{{'/'}}" class="absolute top-5 left-5 flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z"/>
            </svg>
            <h1 class="font-bold text-black text-xl mb-1">Ubah Kata Sandi</h1>
        </a>
    </header>
    <main class="flex flex-col w-full h-full">
        <div class="flex flex-col w-full h-auto px-1 py-3">
            <div class="flex flex-col w-full h-auto bg-white rounded-md shadow-md p-5">
                {{--Funtion action change password belum, validasi input form belum.--}}
                <form action="" method="post" class="flex flex-col w-full h-auto gap-y-5">
                    <div class="flex flex-col w-full h-auto gap-y-2">
                        <label for="password" class="font-bold text-black text-md">Kata Sandi Lama</label>
                        <input type="password" name="password" id="password" class="w-full h-10 px-3 border-2 border-gray-300 rounded-md focus:outline-none focus:border-orange-500" required>
                    </div>
                    <div class="flex flex-col w-full h-auto gap-y-2">
                        <label for="newPassword" class="font-bold text-black text-md">Kata Sandi Baru</label>
                        <input type="password" name="newPassword" id="newPassword" class="w-full h-10 px-3 border-2 border-gray-300 rounded-md focus:outline-none focus:border-orange-500" required>
                    </div>
                    <div class="flex flex-col w-full h-auto gap-y-2">
                        <label for="confirmPassword" class="font-bold text-black text-md">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="w-full h-10 px-3 border-2 border-gray-300 rounded-md focus:outline-none focus:border-orange-500" required>
                    </div>
                    <div class="flex flex-col w-full h-auto gap-y-2">
                        <button type="submit" class="w-full h-10 bg-orange-500 text-white font-bold rounded-md shadow-md">Ubah Kata Sandi</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

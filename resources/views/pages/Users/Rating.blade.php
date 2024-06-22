@extends('layouts.Root')
@section('content')
    <header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
        <a href="{{ url('pesanan/status') }}" class="absolute top-5 left-5 flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
            </svg>
            <h1 class="font-bold text-black text-xl mb-1">Rating</h1>
        </a>
    </header>
    <main class="px-4 sm:px-6 py-4">
        {{-- Infomasi UMKM --}}
        <div class="flex items-center gap-x-2">
            <img src="{{ asset('shop-orange.svg') }}" alt="" class="w-10 h-10 sm:w-6 sm:h-6">
            <p class="font-bold text-black text-l sm:text-base">{{ $dataUMKM->nama_umkm }}</p>
        </div>
            {{-- Image cover UMKM --}}
        <div class="flex justify-center mt-4">
            <img src="{{ Storage::url($dataUMKM->logo_umkm) }}" alt="" class="w-32 h-32 sm:w-32 sm:h-32 rounded-full object-cover bg-gray-300">
        </div>

        <div class="w-full h-px bg-gray-300 my-3"></div>
        {{-- Rating --}}
        <div class="flex flex-col items-center gap-4">
            <div class="flex items center gap-x-2">
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
            </div>
            <p class="text-black text-sm font-semibold sm:text-base">Beri rating untuk UMKM ini</p>
        </div>
        <div class="w-full h-px bg-gray-300 my-3"></div>
        {{-- Category button apa yang harus ditingkatkan --}}
        <div class="flex flex-col gap-2">
            <p class="text-black font-semibold text-sm sm:text-base text-center">Apa yang harus ditingkatkan?</p>
            <div class="flex flex-wrap justify-center">
                <button class="bg-gray-300 text-black text-sm sm:text-base py-2 px-4 sm:py-3 sm:px-6 rounded-md m-2">Produk</button>
                <button class="bg-gray-300 text-black text-sm sm:text-base py-2 px-4 sm:py-3 sm:px-6 rounded-md m-2">Layanan</button>
                <button class="bg-gray-300 text-black text-sm sm:text-base py-2 px-4 sm:py-3 sm:px-6 rounded-md m-2">Pengiriman</button>
                <button class="bg-gray-300 text-black text-sm sm:text-base py-2 px-4 sm:py-3 sm:px-6 rounded-md m-2">Harga</button>
                <button class="bg-gray-300 text-black text-sm sm:text-base py-2 px-4 sm:py-3 sm:px-6 rounded-md m-2">Rasa</button>
                <button class="bg-gray-300 text-black text-sm sm:text-base py-2 px-4 sm:py-3 sm:px-6 rounded-md m-2">Porsi</button>
                <button class="bg-gray-300 text-black text-sm sm:text-base py-2 px-4 sm:py-3 sm:px-6 rounded-md m-2">Kebersihan</button>
                <button class="bg-gray-300 text-black text-sm sm:text-base py-2 px-4 sm:py-3 sm:px-6 rounded-md m-2">Kualitas</button>
            </div>
        </div>
        <div class="w-full h-px bg-gray-300 my-3"></div>
        {{-- Order details and the rating --}}
        <div class="flex flex-row sm:flex-row justify-between x-gap-2 items-center mb-2">
            <div class="flex flex-col items-start justify-center gap-y-2">
                {{-- Nama Produk --}}
                <div class="flex items-center justify-center gap-x-2">
                    {{-- Qty --}}
                    <div class="flex items-center justify-center gap-x-2">
                        <div class="border border-gray-400 px-2 py-1 rounded border-orange-500">
                            <p class="text-black text-sm sm:text-base">1x</p>
                        </div>
                    </div>
                    {{-- Nama Produk --}}
                    <p class="text-black text-sm sm:text-base">Nama Makanan</p>
                </div>
                {{-- Harga --}}
                <div class="flex items-center justify-center gap-x-2 px-5">
                    <p class="text-black text-sm sm:text-base">Rp 10.000</p>
                </div>
            </div>
            {{-- Rating --}}
            <div class="flex items center gap-x-1 sm:gap-x-2 mt-2">
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
            </div>
        </div>
        <div class="flex flex-row sm:flex-row justify-between x-gap-2 items-center mb-2">
            <div class="flex flex-col items-start justify-center gap-y-2">
                {{-- Nama Produk --}}
                <div class="flex items-center justify-center gap-x-2">
                    {{-- Qty --}}
                    <div class="flex items-center justify-center gap-x-2">
                        <div class="border border-gray-400 px-2 py-1 rounded border-orange-500">
                            <p class="text-black text-sm sm:text-base">1x</p>
                        </div>
                    </div>
                    {{-- Nama Produk --}}
                    <p class="text-black text-sm sm:text-base">Nama Makanan</p>
                </div>
                {{-- Harga --}}
                <div class="flex items-center justify-center gap-x-2 px-5">
                    <p class="text-black text-sm sm:text-base">Rp 10.000</p>
                </div>
            </div>
            {{-- Rating --}}
            <div class="flex items center gap-x-1 sm:gap-x-2 mt-2">
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 text-yellow-500 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
            </div>
        </div>
        <div class="w-full h-px bg-gray-300 my-3"></div>
        {{-- Review --}}
        <div class="flex flex-col gap-2">
            <p class="text-black text-sm sm:text-base">Review</p>
            <textarea name="review" id="review" cols="30" rows="5" class="w-full border-2 border-gray-300 rounded-md p-2"></textarea>
        </div>
        <div class="w-full h-px bg-gray-300 my-3"></div>
        {{-- Button --}}
        <div class="flex justify-center">
            <button class="bg-[#F9832A] text-white font-bold text-sm sm:text-base py-2 px-4 sm:py-3 sm:px-6 rounded-md">Kirim</button>
        </div>
    </main>
@endsection

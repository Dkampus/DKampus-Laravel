@extends('layouts.Root')
@section('content')
    <header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
        <a href="pesanan/status" class="absolute top-5 left-5 flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
            </svg>
            <h1 class="font-bold text-black text-xl mb-1">Status Pesanan</h1>
        </a>
    </header>
    <main class="px-4 sm:px-6 py-4">
        <div class="flex flex-col items-center justify-start gap-1">
            <p class="font-bold text-[#F9832A] text-lg sm:text-xl">{{ ucfirst($status) }}</p>
            <p class="text-gray-400 text-xs">
                <a href="#" class="text-[#F9832A]">2024-12-12 12:12:12</a>
            </p>
        </div>
        <div class="w-full h-px bg-gray-300 my-3"></div>

        <div class="flex justify-between items-center gap-3 p-2">
            <div class="flex items-center">
                <img src="{{ asset('images/ProfilePicture.png') }}" alt="" class="w-10 h-10 sm:w-14 sm:h-14 rounded-full object-cover bg-gray-300">
                <div class="flex flex-col gap-1 mx-2">
                    <h1 class="font-bold text-black text-sm sm:text-base">{{ $nama_driver }}</h1>
                </div>
            </div>
            <form action="{{ route('room.chat') }}" method="POST">
                @csrf
                <button type="submit" class="w-7 sm:w-6">
                    <img src="/bubbleChat.svg" alt="Chat Icon" class="w-full">
                </button>
                <input type="text" class="hidden" value="{{ $history->cour_id ?? '' }}" name="courId">
            </form>
        </div>

        <div class="w-full h-px bg-gray-300 my-3"></div>
        <div class="grid grid-cols-2 gap-2">
            <div class="flex items-center gap-x-2">
                <img src="{{ asset('shop-orange.svg') }}" alt="" class="w-4 h-4 sm:w-6 sm:h-6">
                <p class="font-bold text-black text-sm sm:text-base">{{ $nama_umkm }}</p>
            </div>
            <div class="text-right">
                <p class="text-black text-sm sm:text-base"> Order ID:</p>
                <p class="text-black font-bold text-right uppercase text-sm sm:text-base">#TRX{{ strtoupper(substr($orderId, 0, 10)) }}</p>
            </div>

            <p class="text-black text-sm sm:text-base">Pembayaran</p>
            <img src="{{ asset('qris.svg') }}" alt="" class="w-8 h-8 sm:w-10 sm:h-10 ml-auto">

            <p class="text-black text-sm sm:text-base">Subtotal</p>
            <p class="text-black text-right text-sm sm:text-base">Rp {{ number_format($total, 0, ',', '.') }}</p>

            <p class="text-black text-sm sm:text-base">Ongkir</p>
            <p class="text-black text-right text-sm sm:text-base">Rp {{ number_format($ongkir, 0, ',', '.') }} </p>

            <p class="text-black text-sm sm:text-base">Total</p>
            <p class="text-black text-right text-sm sm:text-base">Rp {{ number_format($total + $ongkir, 0, ',', '.') }}</p>
        </div>
        <div class="w-full h-px bg-gray-300 my-3"></div>

        <div class="flex justify-center items-center mt-4">
            <a href="{{ 'history' }}" class="bg-[#F9832A] hover:bg-[#d87525] text-white font-bold py-2 px-4 rounded-md text-sm sm:text-base">
                Kembali ke Status Order
            </a>
        </div>
    </main>
@endsection

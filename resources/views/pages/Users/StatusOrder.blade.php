@extends('layouts.Root')
@section('content')
<header class="sticky top-0 left-0 flex justify-start w-full bg-white z-10 shadow-md py-3 mb-5">
    <div class="flex flex-row items-center h-full">
        <a href="{{'/'}}" class="top-5 left-5 flex items-center px-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
            </svg>
        </a>
        <p class="font-bold text-black text-l mb-1">Status Pesanan</p>
    </div>
</header>
<main>
    {{--Status--}}
    <div class="flex flex-col items-center justify-start gap-1">
        {{-- Status Pesanan --}}
        <p class="font-bold text-[#F9832A] text-xl">{{ $status }}</p>
    </div>
    {{-- Driver information --}}
    @if ($nama_driver != null)
    <div class="flex justify-between items-center gap-3 p-2">
        <div class="flex items-center">
            <img src="{{ asset('images/ProfilePicture.png') }}" alt="" class="w-14 h-14 rounded-full object-cover bg-gray-300">

            <div class="flex flex-col gap-1 mx-2">
                <h1 class="font-bold text-black">{{ $nama_driver }}</h1>
            </div>

        </div>
        {{-- Chat button --}}
        <a href="" class="flex items-center gap-2">
            <img src="{{ asset('chat.svg') }}" alt="" class="w-6 h-6">
        </a>
    </div>
    @endif
    {{-- Order items --}}
    <div class="w-full h-0.5 bg-gray-300 mb-2 mt-2"></div>
    <div class="flex justify-start items-center gap-x-2 p-2 mx-2">
        <img src="{{ asset('shop-orange.svg') }}" alt="" class="w-6 h-6">
        <p class="font-bold text-black">{{ $nama_umkm }}</p>
    </div>
    <div class="flex justify-between items-center gap-x-2 p-2 mx-2">
        <p class="text-black"> Order ID</p>
        <p class="text-black text-right">#{{ $orderId }}</p>
    </div>
    <div class="flex justify-between items-center gap-x-2 p-2 mx-2">
        <p class="text-black"> Order</p>
        @foreach ($orders as $order => $item)
        <p class="font-bold text-black">{{ $item['jumlah'] }} {{ $item['nama'] }}</p>
        @if (!$loop->last)
        <span>,</span>
        @endif
        @endforeach
    </div>
    <div class="flex justify-between items-center gap-x-2 px-2 mx-2">
        <p class="text-black">Pembayaran</p>
        <img src="{{ asset('qris.svg') }}" alt="" class="w-10 h-10">
    </div>
    <div class="flex justify-between items-center gap-x-2 p-2 mx-2">
        <p class="text-black">Subtotal</p>
        <p class="text-black text-right">Rp {{ number_format($subTotal, 0, ',', '.') }}</p>
    </div>
    <div class="flex justify-between items-center gap-x-2 p-2 mx-2">
        <p class="text-black">Ongkir</p>
        <p class="text-black text-right">Rp {{ number_format($ongkir, 0, ',', '.') }}</p>
    </div>
    <div class="flex justify-between items-center gap-x-2 p-2 mx-2">
        <p class="text-black">Total</p>
        <p class="text-black text-right">Rp {{ number_format($total, 0, ',', '.') }}</p>
    </div>
    {{-- Button kembali ke halaman status order --}}
    <div class="flex justify-center items-center gap-2 p-2 mx-2">
        <a href="{{ 'pesanan/status' }}" class="flex items center gap-2 bg-[#F9832A] text-white px-5 py-2 rounded-md">Kembali ke Status Order</a>
    </div>
</main>
@endsection
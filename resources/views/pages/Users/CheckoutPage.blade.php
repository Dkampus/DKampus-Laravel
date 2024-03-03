@extends('layouts.Root')
@section('content')
    <header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
        <a href="{{url()->previous()}}" class="absolute top-5 left-5 flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z"/>
            </svg>
        </a>
        <h1 class="font-bold text-black text-2xl">Pemesanan</h1>
    </header>
    <main class="flex flex-col w-full h-full">
        {{-- tolong buat header dari nama toko sebelum perulangan item2 pada cart --}}
        @php $nama_toko = $carts[0]->menu->data_umkm_id @endphp
        <div class="bg-orange-500 flex items-center p-2 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M3 10h18M3 14h18M3 18h18"></path>
            </svg>
            <h2 class="font-bold text-white text-2xl ml-2">{{$nama_toko}}</h2>
        </div>
        @foreach($carts as $cart)
            <div class="flex flex-col w-full h-auto px-1 py-2">
                <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-4">
                    <div class="flex items-center gap-x-2">
                        <div class="bg-orange-500 text-white text-sm px-2 py-1 rounded">
                            {{$cart->quantity}}
                        </div>
                        <p class="text-black text-md">{{$cart->menu->nama_makanan}}</p>
                    </div>
                    <p class="font-normal text-black text-md ml-auto">Rp{{ number_format($cart->menu->harga * $cart->quantity, 0, '.', ',') }}</p>
                </div>
                <div class="flex items-center gap-x-2 ml-5">
                    <a href="#" class="flex items-center gap-x-3 text-blue-700 text-sm">Edit</a>
                </div>
            </div>
        @endforeach
        <div class="flex flex-col w-full h-auto px-1 py-2 bg-gray-200"></div>
        {{--Rangkuman Pembayaran--}}
        @php
            $total = 0;
            foreach($carts as $cart){
                $total += $cart->menu->harga * $cart->quantity;
            }
            $ongkir = 10000;
        @endphp
        <div class="flex flex-col w-full h-auto px-1 py-2">
            <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-4">
                <p class="font-bold text-black text-l">Rangkuman Pembayaran</p>
            </div>
            <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-3">
                <p class="font-normal text-black text-md">Total Harga</p>
                <p class="font-normal text-black text-md ml-auto">Rp{{ number_format($total, 0, '.', ',') }}</p>
            </div>
            <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-3">
                <p class="font-normal text-black text-md">Ongkir</p>
                <p class="font-normal text-black text-md ml-auto">Rp{{ number_format($ongkir, 0, '.', ',') }}</p>
            </div>
            <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-3">
                <p class="font-bold text-black text-md">Total Pembayaran</p>
                <p class="font-bold text-black text-md ml-auto">Rp{{ number_format($total + $ongkir, 0, '.', ',') }}</p>
            </div>
        </div>
        <div class="flex flex-col w-full h-auto px-1 py-1 bg-gray-200"></div>
        {{--Pembayaran--}}
        <div class="flex flex-col w-full h-auto px-1 py-2">
            <div class="flex flex-row items-center w-full h-auto bg-white rounded-md p-4">
                <p class="font-bold text-black text-l">Pembayaran</p>
            </div>
            <a href="#" class="flex items-center">
                <img src="{{ asset('qris.svg') }}" alt="QRIS" class="w-12 h-12 mx-4"> <!-- Ubah ukuran sesuai kebutuhan -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 ml-auto text-orange-500"> <!-- Ubah ukuran dan margin sesuai kebutuhan -->
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        <div class="flex flex-col w-full h-auto px-1 py-1 bg-gray-200"></div>
        {{--Alamat Pengiriman--}}
        disini alamat
    </main>
@endsection

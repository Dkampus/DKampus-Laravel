@extends('layouts.Root')
@section('content')
    @php
        // temporary data
        // chat id
        $chat = [
            'id' => '888E7CBDE6'
         ];
        // order details data
        $umkm = 'Warung Ayam Baghdad';
        $orderStatus = 'Makanan sedang disiapkan';
        $cart = 'Mesen kamu ga pake apa apa.';
        $total = 50000;
        // driver info
        $driver = [
            'name' => 'Budi',
            'phone' => '08123456789',
            'motor' => 'Ninja 250',
            'plate' => 'B 1234 ABC'
        ];
    @endphp
    <header class="sticky top-0 left-0 flex justify-start w-full bg-white z-10 shadow-md py-3 mb-5">
        <div class="flex flex-row items-center h-full">
            <a href="{{'/'}}" class="top-5 left-5 flex items-center px-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z"/>
                </svg>
            </a>
            <p class="font-bold text-black text-l mb-1">Status Pesanan</p>
        </div>
    </header>
    <main>
        {{--Status--}}
        <div class="flex flex-col items-center justify-start gap-1">
            {{-- Status Pesanan --}}
            <p class="font-bold text-[#F9832A] text-xl">{{ $orderStatus }}</p>
            {{-- Time --}}
            <p class="text-gray-400 text-xs">
                @php
                    date_default_timezone_set('Asia/Jakarta');
                    echo date('H:i');
                @endphp
            </p>
        </div>
        <div class="w-full h-0.5 bg-gray-300 mb-2 mt-2"></div>
        {{-- Driver information --}}
        <div class="flex justify-between items-center gap-3 p-2">
            <div class="flex items-center">
                <img src="{{ asset('images/ProfilePicture.png') }}" alt="" class="w-14 h-14 rounded-full object-cover bg-gray-300">
                <div class="flex flex-col gap-1 mx-2">
                    <h1 class="font-bold text-black">{{ $driver['name'] }}</h1>
                    <p class="text-gray-400">{{ $driver['motor'] }} - {{ $driver['plate'] }}</p>
                </div>
            </div>
            {{-- Chat button --}}
            <a href="{{ '/chats/' . $chat['id'] }}" class="flex items-center gap-2">
                <img src="{{ asset('chat.svg') }}" alt="" class="w-6 h-6">
            </a>
        </div>
        {{-- Order items --}}
        <div class="w-full h-0.5 bg-gray-300 mb-2 mt-2"></div>
        <div class="flex justify-start items-center gap-x-2 p-2 mx-2">
            <img src="{{ asset('shop-orange.svg') }}" alt="" class="w-6 h-6">
            <p class="font-bold text-black">{{ $umkm }}</p>
        </div>
        <div class="flex justify-between items-center gap-x-2 p-2 mx-2">
            <p class="text-black"> Order ID</p>
            <p class="text-black text-right">#{{ $id }}</p>
        </div>
        <div class="flex justify-between items-center gap-x-2 px-2 mx-2">
            <p class="text-black">Pembayaran</p>
            <img src="{{ asset('qris.svg') }}" alt="" class="w-10 h-10">
        </div>
        <div class="flex justify-between items-center gap-x-2 p-2 mx-2">
            <p class="text-black">Subtotal</p>
            <p class="text-black text-right">Rp {{ number_format($total, 0, ',', '.') }}</p>
        </div>
        <div class="flex justify-between items-center gap-x-2 p-2 mx-2">
            <p class="text-black">Ongkir</p>
            <p class="text-black text-right">Rp @php echo number_format(5000, 0, ',', '.'); @endphp</p>
        </div>
        <div class="flex justify-between items-center gap-x-2 p-2 mx-2">
            <p class="text-black">Total</p>
            <p class="text-black text-right">Rp @php echo number_format($total + 5000, 0, ',', '.'); @endphp</p>
        </div>
        {{-- informasi bahwa page ini akan di refresh setiap 5 detik --}}
        <div class="flex justify-center items-center gap-2 p-2 mx-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F9832A" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0-1a6 6 0 1 1-6 6h1V7a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H7a4 4 0 0 0 4 4 4 4 0 0 0 0-8H8V2a1 1 0 0 0-1-1z"/>
            </svg>
            <p class="text-gray-400 text-xs">Halaman ini akan di refresh setiap 5 detik</p>
        </div>
        {{-- Button kembali ke halaman status order --}}
        <div class="flex justify-center items-center gap-2 p-2 mx-2">
            <a href="{{ 'pesanan/status' }}" class="flex items center gap-2 bg-[#F9832A] text-white px-5 py-2 rounded-md">Kembali ke Status Order</a>
        </div>
    </main>
@endsection

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
        @foreach($carts as $cart)
            <div class="flex flex-col w-full h-auto px-1 py-3">
                <div class="flex flex-col w-full h-auto bg-white rounded-md shadow-md p-5">
                    <h1 class="font-bold text-black text-l">Product name</h1>
                    <p class="font-normal text-black text-md">product description</p>
                    <p class="font-normal text-black text-md">Quantity: {{$cart->quantity}}</p>
                    <p class="font-normal text-black text-md">Price: 0</p>
                </div>
            </div>
        @endforeach
        <form method="POST" action="{{}}">
            @csrf
            <div class="flex flex-col w-full h-auto px-1 py-3">
                <div class="flex flex-col w-full h-auto bg-white rounded-md shadow-md p-5">
                    <h1 class="font-bold text-black text-l">Alamat Pengiriman</h1>
                    <select name="alamat" id="alamat" class="w-full h-10 px-3 py-2 bg-white border-2 border-gray-300 rounded-md shadow-md">
                        <option value="Alamat 1">Alamat 1</option>
                        <option value="Alamat 2">Alamat 2</option>
                        <option value="Alamat 3">Alamat 3</option>
                    </select>
                </div>
        </form>
    </main>
@endsection

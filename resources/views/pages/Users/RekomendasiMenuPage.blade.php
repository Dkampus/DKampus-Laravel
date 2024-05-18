@extends('layouts.Root')
@section('content')
    <main>
        {{-- Header --}}
        <header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
            <a href="{{'/'}}" class="absolute top-5 left-5 flex items-center gap-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z"/>
                </svg>
                <h1 class="font-bold text-black text-xl mb-1">{{ $Title }} Terbaik</h1>
            </a>
        </header>
        <div class="flex flex-col mt-2">
            <div class="grid grid-cols-2 gap-5 p-2">
{{--                <a>{{$RekomendasiMenu}}</a>--}}
                @foreach($RekomendasiMenu as $items)
                    <a href="/detail-makanan/{{ $items->nama_makanan }}" class="w-full h-full bg-white rounded-xl shadow-md overflow-hidden">
                        <img src="{{Storage::url($items->image)}}" alt="" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <div class="tracking-wide text-l text-black font-semibold truncate">{{ $items->nama_makanan }}</div>
                            <div class="flex items center mt-1">
                                <img src="{{ asset('shop.svg') }}" alt="" class="w-5 h-5">
                                <p class="text-[#5E5E5E] ml-2 truncate">{{ $umkm->nama_umkm }}</p>
                            </div>
                            <div class="flex justify-between items-center mt-1">
                                <p class="block text lg leading-tight font-medium text-black">Rp {{ number_format($items->harga, 0, ',', '.') }}</p>
                                <div class="flex items center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F9832A" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                    <p class="text-[#5E5E5E] text-m ml-2">{{ $items->rating }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </main>
@endsection


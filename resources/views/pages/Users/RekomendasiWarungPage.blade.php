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
                @foreach($RekomendasiWarung as $items)
                    <a href="/detail-warung/{{ $items->nama_umkm }}" class="w-full h-full bg-white rounded-xl shadow-md overflow-hidden">
                        <img src="{{Storage::url($items->logo_umkm)}}" alt="" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <div class="tracking-wide text-l text-black font-semibold">{{ $items->nama_umkm }}</div>
                            <div class="flex items center mt-1">
                                <img src="{{ asset('shop.svg') }}" alt="" class="w-5 h-5">
                                <p class="text-[#5E5E5E] ml-2 truncate">{{ $items->alamat }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </main>
@endsection


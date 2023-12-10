@extends('pages.Users.Homepage')
@section('subnav-homepage')
<div id="cardList" class="grid grid-cols-5 gap-x-4 py-5">
    @foreach ($UntukKamu as $item)
    <div class="h-[20rem] flex flex-col relative justify-between bg-white border-2 rounded-xl overflow-hidden transition-all duration-300 my-2 hover:shadow-md">
        <img src='{{$item['Img']}}' alt="" class="w-full h-[14rem] object-cover relative">
        {{-- Description Card --}}
        <div class="w-full flex flex-row items-center justify-between py-4 scale-95">
        {{-- Title & Warung --}}
        <div class="flex flex-col justify-between gap-3 items-start h-full">
            <h1 class="text-wrapper font-semibold text-[4vw] sm:text-xl">{{$item['Title']}}</h1>
            <div class="flex flex-row items-center gap-1">
                <img src='Iconly/Bold/Star.svg' alt="" class="w-5">
                <h1 class="text-black font-light">{{$item['Ratings']}}</h1>
            </div>
        </div>

        {{-- Ratings & Price --}}
        <div class="flex flex-col justify-between items-end h-full">
            <a href="#" class="flex flex-row gap-2 items-center">
                <img src="shop.svg" alt="" class="w-4">
                <h1 class="text-[#787878] text-warung-wrapper text-base">{{$item['Warung']}}</h1>
            </a>
            <h1 class="text-[#F9832A] font-semibold text-[4vw] sm:text-lg">Rp. {{$item['Price']}}</h1>
        </div>
        
        </div>
    </div>
    @endforeach
</div>
<button id="seeMore" class="border-2 py-3 flex flex-row items-center justify-center gap-3 border-[#F9832A] text-lg text-[#F9832A] font-semibold rounded-lg">Tekan untuk Melihat Semua
    <img src="down.svg" alt="" class="w-5">
</button>
@endsection
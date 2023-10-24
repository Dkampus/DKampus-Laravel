@extends('layouts.Root')
    @section('content')
    <header>
    {{-- Navbar --}}
    @include('components.header.topbar')
    </header>
    <main class="">
    {{-- Carousel Banner --}}
    <x-banner.carousel>
        @foreach ($Banner as $item)
        <swiper-slide class="w-full">
           <img src={{$item['Img']}} alt="" class="h-full w-full"> 
        </swiper-slide>
        @endforeach
    </x-banner.carousel>

    {{-- Carousel Category --}}
    <div class="flex flex-row items-start relative">
        {{-- <div class="bg-gradient-to-r from-white from-[30%] to-transparent w-14 z-50 h-28 fixed  left-0"></div> --}}
        <x-carousel.slider-category>
            @foreach ($Carousel as $item)
                <swiper-slide class="w-28 h-24 border-2 shadow-md rounded-xl flex flex-col justify-center items-center">
                    <div class="flex flex-col justify-center items-center">
                    <img src={{$item['Icon']}} alt="" class="scale-150">
                    <h1 class="font-normal">{{$item['Title']}}</h1>
                    </div>
                </swiper-slide>
            @endforeach
        </x-carousel.slider-category>
        {{-- <div class="bg-gradient-to-l from-white from-[30%] to-transparent w-14 z-50 h-28 fixed right-0"></div> --}}
    </div>

    {{-- Rekomendasi Warung --}}
    <div class="flex flex-row justify-between items-center px-6 my-5">
        <h1 class="font-semibold text-2xl">Rekomendasi Warung</h1>
        <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
    </div>
    <x-list-warung.slider>
        @forelse ($RekomendasiWarung as $Item)
            <swiper-slide class="w-32 h-[17rem] bg-white border-2 rounded-xl overflow-hidden transition-all duration-300 my-2 hover:shadow-md">
                <img src={{$Item['Img']}} alt="" class="w-[40rem] h-40 object-cover">
                <div class="flex flex-col px-3 h-24 justify-center">
                <div class="flex flex-row gap-1">
                <img src={{$Item['IconTime']}} alt="" class="w-5">
                <h1 class="text-[#F9832A]">{{$Item['Time']}}</h1>
                </div>
                <h1 class="font-semibold text-xl">{{$Item['Title']}}</h1>
                </div>
            </swiper-slide>
        @empty
        <p>Data is not Found</p>
        @endforelse
    </x-list-warung.slider>

    {{-- Rekomendasi Makanan --}}
    <div class="flex flex-row justify-between items-center px-6 mt-10 mb-5">
        <h1 class="font-semibold text-2xl">Rekomendasi Makanan</h1>
        <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
    </div>
    <x-list-food.slider>
        @foreach ($RekomendasiMakanan as $Item)
            <div class="w-[29rem] h-max flex flex-col relative justify-evenly bg-white border-2 rounded-xl overflow-hidden transition-all duration-300 my-2 hover:shadow-md">
                <img src={{$Item['Img']}} alt="" class="w-[40rem] h-60 object-cover relative top-0">
                {{-- Description Card --}}
                <div class="flex flex-col items-center justify-around px-3 gap-2 py-4">
                {{-- Title & Ratings --}}
                <div class="flex flex-row justify-between w-full items-center h-full">
                    <h1 class="text-wrapper font-semibold text-2xl">{{$Item['Title']}}</h1>
                    <div class="flex flex-row gap-2 items-center">
                        <img src="shop.svg" alt="" class="w-4">
                        <h1 class="text-[#787878]">{{$Item['Warung']}}</h1>
                    </div>
                </div>

                {{-- Warung & Price --}}
                <div class="flex flex-row justify-between w-full items-center h-full">
                    <div class="flex flex-row items-center gap-1">
                        <img src='Iconly/Bold/Star.svg' alt="" class="w-5">
                        <h1 class="text-black font-light">{{$Item['Ratings']}}</h1>
                    </div>
                    <h1 class="text-[#F9832A] font-semibold text-2xl">{{$Item['Price']}}</h1>
                </div>
                </div>
            </div>
        @endforeach
    </x-list-food.slider>
    </main>
    @include('components.scrollBehaviourr.scroll-behaviour')
@endsection
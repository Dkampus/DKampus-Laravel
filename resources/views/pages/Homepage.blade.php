@extends('layouts.HomeLayout')
@section('content')
    {{-- Navbar --}}
    @include('components.header.navbar')

    {{-- Carousel Banner --}}
    <x-banner.carousel>
        @foreach ($Banner as $item)
        <swiper-slide>
           <img src={{$item['Img']}} alt="" class="h-full"> 
        </swiper-slide>
        @endforeach
    </x-banner.carousel>

    {{-- Carousel Category --}}
    <div class="flex flex-row items-start relative">
    <div class="bg-gradient-to-r from-white from-[10%] to-transparent w-14 z-50 h-28 fixed  left-0"></div>
    <x-carousel.slider-category>
        @foreach ($Carousel as $item)
            <swiper-slide class="w-32 h-24 border shadow-md rounded-xl flex flex-col justify-center items-center">
                <div class="flex flex-col justify-center items-center">
                <img src={{$item['Icon']}} alt="" class="scale-150">
                <h1 class="font-normal">{{$item['Title']}}</h1>
                </div>
            </swiper-slide>
        @endforeach
        <div class="swiper-button-next relative z-[70]"></div>
        <div class="swiper-button-prev relative z-[70]"></div>
    </x-carousel.slider-category>
    <div class="bg-gradient-to-l from-white from-[10%] to-transparent w-14 z-50 h-28 fixed right-0"></div>
    </div>

    {{-- Rekomendasi Warung --}}
    <div class="flex flex-row justify-between items-center px-5 my-3">
    <h1 class="font-semibold text-xl">Rekomendasi Warung</h1>
    <a href="" class="text-[#F9832A] font-semibold">Lihat Semua</a>
    </div>
    <x-list-food.slider>
        @foreach ($RekomendasiWarung as $Item)
            <swiper-slide>
                <img src={{$Item['Img']}} alt="">
            </swiper-slide>
        @endforeach
    </x-list-food.slider>
@endsection
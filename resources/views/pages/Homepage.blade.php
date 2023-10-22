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
    <div class="flex flex-row items-center">
    <div class="bg-gradient-to-r from-white from-[25%] to-transparent w-14 z-50 h-36 fixed left-0"></div>
    <x-carousel.slide-category>
        @foreach ($Carousel as $item)
            <swiper-slide class="w-full h-24 border shadow-md rounded-xl flex flex-col justify-center items-center">
                <div class="flex flex-col justify-center items-center">
                <img src={{$item['Icon']}} alt="" class="scale-150">
                <h1 class="font-normal">{{$item['Title']}}</h1>
                </div>
            </swiper-slide>
        @endforeach
    </x-carousel.slide-category>
    <div class="bg-gradient-to-l from-white from-[25%] to-transparent w-14 z-50 h-36 fixed right-0"></div>
    </div>
@endsection`
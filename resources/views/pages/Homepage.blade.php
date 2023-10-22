@extends('layouts.HomeLayout')
@section('content')
    {{-- Navbar --}}
    @include('components.header.navbar')

    {{-- Carousel Banner --}}
    <x-carousel.carousel>
        @foreach ($Banner as $item)
        <swiper-slide>
           <img src={{$item['Img']}} alt="" class="h-full"> 
        </swiper-slide>
        @endforeach
    </x-carousel.carousel>

    {{-- Carousel Category --}}
    <x-banner.slide-category>
        <swiper-slide class="h-full"></swiper-slide>
        <swiper-slide class="h-full"></swiper-slide>
    </x-banner.slide-category>
@endsection`
@extends('layouts.HomeLayout')
@section('content')
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Carousel Banner --}}
    <x-carousel>
        @foreach ($Banner as $item)
        <swiper-slide>
           <img src={{$item['Img']}} alt="" class="h-full"> 
        </swiper-slide>
        @endforeach
    </x-carousel>

    {{-- Carousel Category --}}
    <x-slide-category>
        <swiper-slide class="h-full"></swiper-slide>
        <swiper-slide class="h-full"></swiper-slide>
        <swiper-slide class="h-full"></swiper-slide>
        <swiper-slide class="h-full"></swiper-slide>
        <swiper-slide class="h-full"></swiper-slide>
        <swiper-slide class="h-full"></swiper-slide>
    </x-slide-category>
@endsection`
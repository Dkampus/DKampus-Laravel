@extends('layouts.HomeLayout')
@section('content')
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Carousel Banner --}}
    <x-carousel>
        <swiper-slide class="h-full"><img src="banner.jpg" alt="" class="h-full"></swiper-slide>
        <swiper-slide class="h-full"><img src="banner.jpg" alt="" class="h-full"></swiper-slide>
        <swiper-slide class="h-full"><img src="banner.jpg" alt="" class="h-full"></swiper-slide>
    </x-carousel>

    {{-- Carousel Category --}}
    
@endsection`
@extends('layouts.HomeLayout')
@section('content')
    @include('components.navbar')
    <x-carousel>
        <swiper-slide class="h-full"><img src="banner.jpg" alt="" class="h-full"></swiper-slide>
        <swiper-slide class="h-full"><img src="banner.jpg" alt="" class="h-full"></swiper-slide>
        <swiper-slide class="h-full"><img src="banner.jpg" alt="" class="h-full"></swiper-slide>
    </x-carousel>
@endsection`
@extends('layouts.Root')
    @section('content')
    <header class="sticky top-0 bg-white z-10">
        {{-- Topbar --}}
        @include('components.header.topbar')
    </header>

    <main class="md:mx-14">
        {{-- Carousel Banner --}}
        <x-banner.carousel>
            @foreach ($Banner as $item)
            <swiper-slide class="w-full flex flex-row items-center relative rounded-xl overflow-hidden">
            <div class="absolute w-[50%] text-center">
                <h1 class="text-white font-semibold md:leading-snug text-3xl md:text-6xl">Welcome to <br> Dkampus👋</h1>
            </div>
            <img src={{$item['Img']}} alt="" class="h-full w-full"> 
            </swiper-slide>
            @endforeach
        </x-banner.carousel>

        {{-- Carousel Category --}}
        <div class="flex flex-row items-start relative">
            {{-- <div class="bg-gradient-to-r from-white from-[30%] to-transparent w-14 z-50 h-28 fixed  left-0"></div> --}}
            <x-carousel.slider-category>
                @foreach ($Carousel as $item)
                    <swiper-slide class="w-28 h-24 border-2 shadow-md rounded-xl flex flex-col justify-center items-center transition-all duration-300 my-2 hover:shadow-none">
                        <div class="flex flex-col justify-evenly h-full items-center">
                        <img src={{$item['Icon']}} alt="" class="scale-150 md:scale-[2]">
                        <h1 class="font-normal">{{$item['Title']}}</h1>
                        </div>
                    </swiper-slide>
                @endforeach
            </x-carousel.slider-category>

            <x-carousel.slider-category-desktop>
                @foreach ($CarouselDesktop as $item)
                    <swiper-slide id="category" class="w-28 h-24 border-2 shadow-md rounded-xl flex flex-col justify-center items-center transition-all duration-300 my-2 hover:shadow-none">
                        <div class="flex flex-col justify-evenly h-full items-center">
                        <img src={{$item['Icon']}} alt="" class="scale-150 md:scale-[2]">
                        <h1 class="font-normal text-lg">{{$item['Title']}}</h1>
                        </div>
                    </swiper-slide>
                @endforeach
            </x-carousel.slider-category-desktop>
            {{-- <div class="bg-gradient-to-l from-white from-[30%] to-transparent w-14 z-50 h-28 fixed right-0"></div> --}}
        </div>

        {{-- Rekomendasi Warung --}}
        <div class="flex flex-row justify-between items-center mb-5 mt-10">
            <h1 class="font-semibold w-max text-[4.5vw] sm:text-2xl">Rekomendasi Warung</h1>
            <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
        </div>

        {{-- Slider Rekomendasi Warung --}}
        <x-list.slider>
            @forelse ($RekomendasiWarung as $item)
                <swiper-slide class="w-96 h-[17rem] mx-0.5 relative border-2 rounded-xl transition-all duration-300 hover:shadow-md">
                    <img src="/discount50%.svg" alt="" class="fixed z-[60] top-5 w-16 -left-2.5 md:w-[4vw]">
                    <a href="/detail-warung/{{$item->slug}}" class="w-full h-full bg-white overflow-hidden">
                        <img src={{$item->logo_umkm}} alt="" class="w-[45rem] h-40 object-cover rounded-xl">
                        <div class="flex flex-col px-3 h-24 justify-center">
                        <div class="flex w-max flex-row gap-1">
                        <img src=clock.svg alt="" class="w-5">
                        <h1 class="text-[#F9832A] text-sm sm:text-base">09:00 - 21:00</h1>
                        </div>
                        <h1 class="font-semibold text-[3vw] text-base sm:text-xl">{{$item->nama_umkm}}</h1>
                        </div>
                    </a>
                </swiper-slide>
            @empty
            <p>Data is not Found</p>
            @endforelse
        </x-list.slider>


        {{-- Rekomendasi Makanan --}}
        <div class="flex flex-row justify-between items-center mt-10 mb-5">
            <h1 class="font-semibold w-max text-[4.5vw] sm:text-2xl">Rekomendasi Makanan</h1>
            <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
        </div>

        {{-- Slider Rekomendasi Makanan --}}
        <x-list.slider-makanan>
            @foreach ($RekomendasiMakanan as $menu)
            @php $harga = number_format($menu->harga, 0, ',', '.'); @endphp
                <swiper-slide class="h-[20rem] flex flex-col relative justify-between bg-white border-2 rounded-xl overflow-hidden transition-all duration-300 my-2 hover:shadow-md">
                    <img src={{$menu->image}} alt="" class="w-full h-[14rem] object-cover relative">
                    {{-- Description Card --}}
                    <div class="w-full flex flex-row items-center justify-between px-3 py-4">
                    {{-- Title & Warung --}}
                    <div class="flex flex-col justify-between gap-3 items-start h-full">
                        <h1 class="text-wrapper font-semibold text-[4vw] sm:text-2xl">{{$menu->nama_makanan}}</h1>
                        <div class="flex flex-row items-center gap-1">
                            <img src='Iconly/Bold/Star.svg' alt="" class="w-5">
                            <h1 class="text-black font-light">{{$menu->rating}}</h1>
                        </div>
                    </div>

                    {{-- Ratings & Price --}}
                    <div class="flex flex-col justify-between items-end h-full">
                        <div class="flex flex-row gap-2 items-center">
                            <img src="shop.svg" alt="" class="w-4">
                            <h1 class="text-[#787878] text-wrapper">{{$menu->data_umkm->nama_umkm}}</h1>
                        </div>
                        <h1 class="text-[#F9832A] font-semibold text-[4vw] sm:text-2xl">Rp. {{$harga}}</h1>
                    </div>
                    
                    </div>
                </swiper-slide>
            @endforeach
        </x-list.slider>

        {{-- Card list Rekomendasi Makanan --}}
        <x-list-food.slider>
            @foreach ($RekomendasiMakanan as $menu)
            @php $harga = number_format($menu->harga, 0, ',', '.'); @endphp
                <div class="food-list-scrollTrigger w-full h-max flex flex-col relative justify-evenly bg-white border-2 rounded-xl overflow-hidden transition-all duration-300 my-2 hover:shadow-md">
                    <img src={{$menu->image}} alt="" class="w-[40rem] h-60 object-cover relative top-0">
                    {{-- Description Card --}}
                    <div class="w-full flex flex-row items-center justify-between px-3 py-4">
                    {{-- Title & Warung --}}
                    <div class="flex flex-col justify-between items-start h-full">
                        <h1 class="text-wrapper font-semibold text-[4vw] sm:text-2xl">{{$menu->nama_makanan}}</h1>
                        <div class="flex flex-row items-center gap-1">
                            <img src='Iconly/Bold/Star.svg' alt="" class="w-5">
                            <h1 class="text-black font-light">{{$menu->rating}}</h1>
                        </div>
                    </div>

                    {{-- Ratings & Price --}}
                    <div class="flex flex-col justify-between items-end h-full">
                        <div class="flex flex-row gap-2 items-center">
                            <img src="shop.svg" alt="" class="w-4">
                            <h1 class="text-[#787878] text-wrapper">{{$menu->data_umkm->nama_umkm}}</h1>
                        </div>
                        <h1 class="text-[#F9832A] font-semibold text-[4vw] sm:text-2xl">Rp. {{$harga}}</h1>
                    </div>
                    </div>
                </div>
            @endforeach
        </x-list-food.slider>

        <div class="pt-10 pb-5 hidden md:flex md:flex-col">
        <nav class="flex flex-row items-center gap-3">@include('components.navbar.subnavbar-homepage')</nav>
        @yield('subnav-homepage')
        </div>
    </main>

    <footer>
        
    </footer>
    
    {{-- Scroll Behaviour --}}
    @include('components.scrollBehaviourr.scroll-behaviour')
@endsection
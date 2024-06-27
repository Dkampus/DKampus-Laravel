@extends('layouts.Root')
@section('content')
<header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10">
    {{-- Topbar --}}
    @include('components.header.topbar')
</header>

<main class="px-3 md:mx-14 md:mb-40">
    {{-- Carousel Banner --}}
    <x-banner.carousel>
        @foreach ($Banner as $item)
        <swiper-slide class="w-full flex flex-row items-center relative rounded-xl overflow-hidden">
            <div class="absolute w-[50%] text-center">
                @if ($item['Img'] != str_contains($item['Img'], 'Jastip'))
                    <h1 class="text-white font-semibold md:leading-snug text-3xl md:text-6xl">Welcome to <br> Dkampus👋
                @else
                @endif
                </h1>
            </div>
            <a href="{{ $item['link'] }}" class="w-full h-full">
                <img src="{{ $item['Img'] }}" alt="" class="h-full w-full">
            </a>
        </swiper-slide>
        @endforeach
    </x-banner.carousel>

    {{-- Carousel Category --}}
    <div class="flex flex-row items-start relative">
        <x-carousel.slider-category>
            @foreach ($Carousel as $item)
            <swiper-slide class="w-28 h-24 border-2 shadow-md rounded-xl flex flex-col justify-center items-center transition-all duration-300 my-2 hover:shadow-none">
                <a href="/kategori/{{ strtolower($item['Title']) }}" class="flex flex-col justify-evenly h-full items-center">
                    <img src="{{ $item['Icon'] }}" alt="" class="scale-150 md:scale-[1.7]">
                    <h1 class="font-normal">{{ $item['Title'] }}</h1>
                </a>
            </swiper-slide>
            @endforeach
        </x-carousel.slider-category>

        <x-carousel.slider-category-desktop>
            @foreach ($CarouselDesktop as $item)
            <swiper-slide id="category" class="w-28 h-24 border-2 shadow-md rounded-xl flex flex-col justify-center items-center transition-all duration-300 my-2 hover:shadow-none">
                <a href="/kategori/{{ strtolower($item['Title']) }}" class="flex flex-col justify-evenly h-full items-center">
                    <img src="{{ $item['Icon'] }}" alt="" class="scale-150 md:scale-[1.5]">
                    <h1 class="font-normal text-lg">{{ $item['Title'] }}</h1>
                </a>
            </swiper-slide>
            @endforeach
        </x-carousel.slider-category-desktop>
        {{-- <div class="bg-gradient-to-l from-white from-[30%] to-transparent w-14 z-50 h-28 fixed right-0"></div> --}}
    </div>

    {{-- Rekomendasi Warung --}}
    <div class="flex flex-row justify-between items-center my-5 md:mt-10 md:mb-5">
        <h1 class="font-semibold w-max text-[4.5vw] sm:text-2xl">Rekomendasi Warung</h1>
        <a href="/rekomendasi-warung/" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
    </div>

    {{-- Slider Rekomendasi Warung --}}
    <x-list.slider>
        @forelse ($RekomendasiWarung as $index => $item)
        <swiper-slide class="w-96 h-[17rem] mx-0.5 relative border-2 rounded-xl transition-all duration-300 hover:shadow-md">
            {{--<img src="/discount50%.svg" alt="" class="fixed z-[60] top-5 w-16 -left-2.5 md:w-[4vw]">--}}
            <a href="/detail-warung/{{ $item->nama_umkm }}" class="w-full h-full bg-white overflow-hidden">
                <img src="{{ Storage::url($item->logo_umkm) }}" alt="" class="w-[45rem] h-40 object-cover rounded-xl">
                <div class="flex flex-col px-3 h-24 justify-center">
                    <div class="flex w-max flex-row gap-1">
                        <img src=clock.svg alt="" class="w-5">
                        <h1 class="text-[#F9832A] text-sm sm:text-base">{{ date('H:i', strtotime($item->open_time ?? '00:00')) }} - {{ date('H:i', strtotime($item->close_time ?? '00:00')) }}</h1>
                    </div>
                    <h1 class="font-semibold text-[3vw] text-base sm:text-xl text-wrapper">{{ $item->nama_umkm }}</h1>
                    <div class="flex flex-row items-center gap-2">
                        <img src='Iconly/Bold/Star.svg' alt="" class="w-3.2">
                        <h1 class="text-[#787878] text-sm sm:text-base">{{ $item->rating }}</h1>
{{--                        @if ($listJarak != null && Auth::id() != null)--}}
{{--                        @php $distanceInMeters = $listJarak[$index] @endphp--}}
{{--                        @if ($distanceInMeters < 1000) @php $formattedDistance=number_format($distanceInMeters, 0) . ' m' @endphp--}}
{{--                            <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <path d="M7.5 6.125C6.98223 6.125 6.5625 5.73325 6.5625 5.25C6.5625 4.76675 6.98223 4.375 7.5 4.375C8.01777 4.375 8.4375 4.76675 8.4375 5.25C8.4375 5.73325 8.01777 6.125 7.5 6.125Z" fill="#F8832B" />--}}
{{--                            <path d="M7.5 0.875C10.0846 0.875 12.1875 2.75215 12.1875 5.05859C12.1875 6.15699 11.6511 7.6177 10.5932 9.40024C9.74355 10.8314 8.76064 12.1256 8.24941 12.7695C8.16303 12.8796 8.05008 12.969 7.91972 13.0307C7.78937 13.0924 7.64527 13.1245 7.49912 13.1245C7.35297 13.1245 7.20888 13.0924 7.07852 13.0307C6.94816 12.969 6.83521 12.8796 6.74883 12.7695C6.23848 12.1256 5.25469 10.8314 4.40508 9.40024C3.34893 7.61824 2.8125 6.15754 2.8125 5.05859C2.8125 2.75215 4.91543 0.875 7.5 0.875ZM7.5 7C7.87084 7 8.23335 6.89736 8.54169 6.70507C8.85004 6.51278 9.09036 6.23947 9.23227 5.9197C9.37419 5.59993 9.41132 5.24806 9.33897 4.90859C9.26663 4.56913 9.08805 4.25731 8.82583 4.01256C8.5636 3.76782 8.22951 3.60115 7.86579 3.53363C7.50208 3.4661 7.12508 3.50076 6.78247 3.63321C6.43986 3.76566 6.14702 3.98997 5.94099 4.27775C5.73497 4.56554 5.625 4.90388 5.625 5.25C5.62554 5.71397 5.82326 6.1588 6.17477 6.48688C6.52629 6.81496 7.00289 6.99949 7.5 7Z" fill="#F8832B" />--}}
{{--                            </svg>--}}
{{--                            <h1 id="distance_{{ $index }}" class="text-[#787878] text-sm sm:text-base">{{ $formattedDistance ?? '-' }}</h1>--}}
{{--                            @else--}}
{{--                            @php $formattedDistance = number_format($distanceInMeters / 1000, 2) . ' km' @endphp--}}
{{--                            <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M7.5 6.125C6.98223 6.125 6.5625 5.73325 6.5625 5.25C6.5625 4.76675 6.98223 4.375 7.5 4.375C8.01777 4.375 8.4375 4.76675 8.4375 5.25C8.4375 5.73325 8.01777 6.125 7.5 6.125Z" fill="#F8832B" />--}}
{{--                                <path d="M7.5 0.875C10.0846 0.875 12.1875 2.75215 12.1875 5.05859C12.1875 6.15699 11.6511 7.6177 10.5932 9.40024C9.74355 10.8314 8.76064 12.1256 8.24941 12.7695C8.16303 12.8796 8.05008 12.969 7.91972 13.0307C7.78937 13.0924 7.64527 13.1245 7.49912 13.1245C7.35297 13.1245 7.20888 13.0924 7.07852 13.0307C6.94816 12.969 6.83521 12.8796 6.74883 12.7695C6.23848 12.1256 5.25469 10.8314 4.40508 9.40024C3.34893 7.61824 2.8125 6.15754 2.8125 5.05859C2.8125 2.75215 4.91543 0.875 7.5 0.875ZM7.5 7C7.87084 7 8.23335 6.89736 8.54169 6.70507C8.85004 6.51278 9.09036 6.23947 9.23227 5.9197C9.37419 5.59993 9.41132 5.24806 9.33897 4.90859C9.26663 4.56913 9.08805 4.25731 8.82583 4.01256C8.5636 3.76782 8.22951 3.60115 7.86579 3.53363C7.50208 3.4661 7.12508 3.50076 6.78247 3.63321C6.43986 3.76566 6.14702 3.98997 5.94099 4.27775C5.73497 4.56554 5.625 4.90388 5.625 5.25C5.62554 5.71397 5.82326 6.1588 6.17477 6.48688C6.52629 6.81496 7.00289 6.99949 7.5 7Z" fill="#F8832B" />--}}
{{--                            </svg>--}}
{{--                            <h1 id="distance_{{ $index }}" class="text-[#787878] text-sm sm:text-base">{{ $formattedDistance ?? '-' }}</h1>--}}
{{--                            <input type="text" value="{{ $item->geo }}" id="umkmAddress" class="hidden">--}}
{{--                            @endif--}}
{{--                            @else--}}
{{--                            <svg class="hidden" width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M7.5 6.125C6.98223 6.125 6.5625 5.73325 6.5625 5.25C6.5625 4.76675 6.98223 4.375 7.5 4.375C8.01777 4.375 8.4375 4.76675 8.4375 5.25C8.4375 5.73325 8.01777 6.125 7.5 6.125Z" fill="#F8832B" />--}}
{{--                                <path d="M7.5 0.875C10.0846 0.875 12.1875 2.75215 12.1875 5.05859C12.1875 6.15699 11.6511 7.6177 10.5932 9.40024C9.74355 10.8314 8.76064 12.1256 8.24941 12.7695C8.16303 12.8796 8.05008 12.969 7.91972 13.0307C7.78937 13.0924 7.64527 13.1245 7.49912 13.1245C7.35297 13.1245 7.20888 13.0924 7.07852 13.0307C6.94816 12.969 6.83521 12.8796 6.74883 12.7695C6.23848 12.1256 5.25469 10.8314 4.40508 9.40024C3.34893 7.61824 2.8125 6.15754 2.8125 5.05859C2.8125 2.75215 4.91543 0.875 7.5 0.875ZM7.5 7C7.87084 7 8.23335 6.89736 8.54169 6.70507C8.85004 6.51278 9.09036 6.23947 9.23227 5.9197C9.37419 5.59993 9.41132 5.24806 9.33897 4.90859C9.26663 4.56913 9.08805 4.25731 8.82583 4.01256C8.5636 3.76782 8.22951 3.60115 7.86579 3.53363C7.50208 3.4661 7.12508 3.50076 6.78247 3.63321C6.43986 3.76566 6.14702 3.98997 5.94099 4.27775C5.73497 4.56554 5.625 4.90388 5.625 5.25C5.62554 5.71397 5.82326 6.1588 6.17477 6.48688C6.52629 6.81496 7.00289 6.99949 7.5 7Z" fill="#F8832B" />--}}
{{--                            </svg>--}}
{{--                            <h1 id="distance_{{ $index }}" class="text-[#787878] text-sm sm:text-base hidden">Data is not Found</h1>--}}
{{--                            @endif--}}
                    </div>
                </div>
            </a>
        </swiper-slide>
        @empty
        <p>Data is not Found</p>
        @endforelse
    </x-list.slider>

    {{-- Rekomendasi Makanan --}}
    <div class="flex flex-row justify-between items-center mt-7 md:mt-10  md:mb-5">
        <h1 class="font-semibold w-max text-[4.5vw] sm:text-2xl">Rekomendasi Makanan</h1>
        <a href="/rekomendasi-menu/" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
    </div>

    {{-- Slider Rekomendasi Makanan --}}
    <x-list.slider-makanan>
        @if ($RekomendasiMakanan->isEmpty())
            <p class="text-center px-5 py-5">Data is not Found</p>
        @endif
        @foreach ($RekomendasiMakanan as $menu)
        @php $harga = number_format($menu->harga, 0, ',', '.'); @endphp
        <swiper-slide class="h-[20rem] w-96 flex flex-col relative justify-between bg-white border-2 rounded-xl overflow-hidden transition-all duration-300 my-2 hover:shadow-md">
            <img src="{{ Storage::url($menu->image) }}" alt="" class="w-full h-[14rem] object-cover relative">
            {{-- Description Card --}}
            <a href="/detail-makanan/{{ $menu->nama_makanan }}" class="w-full flex flex-row items-center justify-between px-3 py-4">
                {{-- Title & Warung --}}
                <div class="flex flex-col justify-between gap-3 items-start h-full">
                    <h1 class="text-wrapper font-semibold text-[4vw] sm:text-2xl">{{ $menu->nama_makanan }}</h1>
                    <div class="flex flex-row items-center gap-1">
                            <img src='Iconly/Bold/Star.svg' alt="" class="w-5">
                        <h1 class="text-black font-light">{{ $menu->rating }}</h1>
                    </div>
                </div>

                {{-- Ratings & Price --}}
                <div class="flex flex-col justify-between items-end h-full">
                    <div class="flex flex-row gap-2 items-center">
                        <img src="shop.svg" alt="" class="w-4">
                        <h1 class="text-[#787878] text-wrapper">{{ $menu->data_umkm->nama_umkm }}</h1>
                    </div>
                    <h1 class="text-[#F9832A] font-semibold text-[4vw] sm:text-2xl">Rp. {{ $harga }}</h1>
                </div>

            </a>
        </swiper-slide>
        @endforeach
    </x-list.slider-makanan>

    {{-- Card list Rekomendasi Makanan --}}
    <x-list-food.slider>
        @if ($RekomendasiMakanan->isEmpty())
            <div class="flex flex-row justify-center items-center w-full h-96">
                <p class="text-center px-5 py-5">Data is not Found</p>
            </div>
        @endif
        @foreach ($RekomendasiMakanan as $menu)
        @php $harga = number_format($menu->harga, 0, ',', '.'); @endphp
        <div class="food-list-scrollTrigger w-full h-max flex flex-col relative justify-evenly bg-white border-2 rounded-xl overflow-hidden transition-all duration-300 my-2 hover:shadow-md">
            <a href="/detail-makanan/{{ $menu->nama_makanan }}" class="w-full h-full bg-white overflow-hidden">
                <img src="{{ Storage::url($menu->image) }}" class="w-[40rem] h-60 object-cover relative top-0">
            </a>
            {{-- Description Card --}}
            <div class="w-full flex flex-row items-center justify-between px-3 py-4">
                {{-- Title & Warung --}}
                <div class="flex flex-col justify-between items-start h-full">
                    <a href="/detail-makanan/{{ $menu->nama_makanan }}" class="text-wrapper font-semibold text-[4vw] sm:text-2xl">{{ $menu->nama_makanan }}</a>
                    <div class="flex flex-row items-center gap-1">
                        <img src='Iconly/Bold/Star.svg' alt="" class="w-5">
                        <h1 class="text-black font-light">{{ $menu->rating }}</h1>
                    </div>
                </div>

                {{-- Ratings & Price --}}
                <div class="flex flex-col justify-between items-end h-full">
                    <div class="flex flex-row gap-2 items-center">
                        <img src="shop.svg" alt="" class="w-4">
                        <h1 class="text-[#787878] text-wrapper">{{ $menu->data_umkm->nama_umkm }}</h1>
                    </div>
                    <h1 class="text-[#F9832A] font-semibold text-[4vw] sm:text-2xl">Rp. {{ $harga }}
                    </h1>
                </div>
            </div>
        </div>
        @endforeach
    </x-list-food.slider>

    {{-- Disable subnav promos --}}
    {{--<div class="pt-11 pb-5 hidden md:flex md:flex-col">
        <nav class="flex flex-row items-center gap-3">@include('components.navbar.subnavbar-homepage')</nav>
        @yield('subnav-homepage')
    </div>--}}
    @if (Auth::user() != null)
        <x-floatingcshelp />
    @endif
</main>

<footer class="md:grid hidden grid-cols-4 w-full bg-gradient-to-t from-[#ED6600] to-[#F9832A] text-white h-[40vh] place-content-evenly px-10 place-items-stretch">
    <div id="part1" class="flex flex-col justify-between mx-auto">
        <h1 class="font-bold text-2xl">Dkampus</h1>
        @forelse ($FooterPart1 as $part1)
        <a href="#">
            {{ $part1['title'] }}
        </a>
        @empty
        @endforelse
    </div>
    <div id="part2" class="grid grid-rows-2 place-items-stretch place-content-stretch mx-auto">
        <div class="flex flex-col justify-center">
            <h1 class="font-bold text-2xl">Beli</h1>
            @forelse ($FooterPart2Beli as $part2Beli)
            <a href="#">
                {{ $part2Beli['title'] }}
            </a>
            @empty
            @endforelse
        </div>
        <div class="flex flex-col justify-center self-end">
            <h1 class="font-bold text-2xl">Jual</h1>
            @forelse ($FooterPart2Jual as $part2Jual)
            <a href="#">
                {{ $part2Jual['title'] }}
            </a>
            @empty
            @endforelse
        </div>
    </div>
    <div id="part3" class="grid grid-rows-2 place-items-stretch place-content-stretch mx-auto">
        <div class="flex flex-col justify-evenly gap-3">
            <h1 class="font-bold text-2xl">Keamanan dan Privasi</h1>
            <div class="flex flex-col gap-3">
                @forelse ($FooterPart3KeamananDanPrivasi as $part3KeamananDanPrivasi)
                <div class="flex flex-row items-center gap-1">
                    <img src="{{ $part3KeamananDanPrivasi['img'] }}" alt="" class="w-5">
                    <a href="#">
                        {{ $part3KeamananDanPrivasi['title'] }}
                    </a>
                </div>
                @empty
                @endforelse
            </div>
        </div>
        <div class="flex flex-col justify-center gap-3 self-end">
            <h1 class="font-bold text-2xl">Ikuti Kami</h1>
            <div class="flex flex-row items-center gap-2">
                @forelse ($FooterPart3IkutiKami as $part3IkutiKami)
                <a href="#">
                    <img src="{{ $part3IkutiKami['img'] }}" alt="" class="w-8">
                </a>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    <div id="part4" class="flex flex-col justify-center items-center gap-5 mx-auto">
        <img src="logoFooter.svg" alt="" class="w-[15vw]">
        <h1 class="font-semibold text-center">© 2021 - 2024,Dkampus Indonesia</h1>
    </div>

</footer>

{{-- Scroll Behaviour --}}
@include('components.scrollBehaviourr.scroll-behaviour')

@endsection

@push('search')

@endpush

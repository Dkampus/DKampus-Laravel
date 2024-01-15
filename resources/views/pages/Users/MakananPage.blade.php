@extends('layouts.PromoLayout')
@section('contentPromo')

    {{-- Title Promo Terlaris --}}
    <div class="flex flex-row justify-between items-center px-5 mb-5 mt-7">
        <h1 class="font-semibold text-2xl">Promo Makanan Terlaris</h1>
        <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
    </div>

    {{-- Carousel Promo Terlaris --}}
    <x-promo-slider.carousel>
        @forelse ($PromoMakananSlider as $Item)
            <swiper-slide class="border transition-all duration-300 w-40 h-60 rounded-xl overflow-hidden shadow-md mb-2">

                {{-- Header Card --}}
                <div id="headerCard" class="w-full">
                    <img src="{{$Item['Discount']}}" alt="" class="absolute">
                    <img src="{{$Item['Img']}}" alt="" class="w-full h-32">
                </div>

                {{-- Content card --}}
                <div id="contentCard" class="px-2 py-2 flex flex-col gap-1 justify-center h-[45%]">

                    {{-- Prices --}}
                    <div id="prices" class="flex flex-row items-center gap-2.5 mt-1 h-max overflow-x-auto">
                        <h1 class="text-[#F9832A] font-bold text-xl">{{$Item['PriceDiscount']}}</h1>
                        <h1 class="line-through text-[#BCBCBC] text-sm sm:text-base font-semibold">{{$Item['PriceOri']}}</h1>
                    </div>

                    {{-- Desc --}}
                    <div id="desc" class="flex flex-col gap-0.5">
                        <h1 class="font-semibold text-lg text-wrapper-promo-terlaris">{{$Item['Title']}}</h1>
                        <div id="ratings" class="w-max overflow-x-scroll flex flex-row items-center gap-1.5">
                            <img src="Iconly/Bold/Star.svg" alt="">
{{--                            <h1>{{$Item['Ratings']}}</h1>--}}
                        </div>
                    </div>
                </div>
            </swiper-slide>
        @empty

        @endforelse
    </x-promo-slider.carousel>

    {{-- Promotion Banner --}}
    <div class="w-full h-60 px-4 mx-auto my-5 rounded-xl overflow-hidden">
        <img src="promote.jpg" alt="" class="w-full h-full object-cover rounded-xl">
    </div>
@endsection

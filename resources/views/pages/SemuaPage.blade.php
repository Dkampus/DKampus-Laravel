@extends('layouts.PromoLayout')
@section('contentPromo')
<div class="flex flex-row justify-between items-center px-5 mb-5 mt-7">
    <h1 class="font-semibold text-2xl">Promo Terlaris</h1>
    <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
</div>
<x-promo-slider.carousel>
   @forelse ($PromoTerlarisSlider as $Item)
    <swiper-slide class="border w-40 h-60 rounded-xl overflow-hidden shadow-md mb-2">
        <div id="headerCard" class="w-full">
            <img src="{{$Item['Discount']}}" alt="" class="absolute">
            <img src="{{$Item['Img']}}" alt="" class="w-full h-32">
        </div>
        <div id="contentCard" class="px-2 py-2 flex flex-col gap-1 justify-center h-[45%]">
            <div id="prices" class="flex flex-row gap-2.5">
                <h1 class="text-[#F9832A] font-bold text-xl">{{$Item['PriceDiscount']}}</h1>
                <h1 class="line-through text-[#BCBCBC] font-semibold">{{$Item['PriceOri']}}</h1>
            </div>
            <div id="desc" class="flex flex-col gap-0.5">
                <h1 class="font-semibold text-lg text-wrapper-promo-terlaris">{{$Item['Title']}}</h1>
                <div id="ratings" class="flex flex-row items-center gap-1.5">
                <img src="Iconly/Bold/Star.svg" alt="">
                <h1>{{$Item['Ratings']}}</h1>
            </div>
            </div>
        </div>
    </swiper-slide>
   @empty
       
   @endforelse
</x-promo-slider.carousel>
@endsection
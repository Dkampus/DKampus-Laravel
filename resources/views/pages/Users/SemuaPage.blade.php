@extends('layouts.PromoLayout')
@section('contentPromo')

{{-- Title Promo Terlaris Mobile --}}
<div class="flex flex-row justify-between items-center px-5 mb-5 mt-7 md:hidden">
    <h1 class="font-semibold text-2xl">Promo Terlaris</h1>
    <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
</div>

{{-- Title Promo Terlaris Desktop --}}
<div id="" class="hidden flex-row justify-between items-center px-5 mb-5 mt-7 md:flex">
    <h1 class="font-semibold text-2xl">Semua Promo yang paling Inginkan</h1>
    <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
</div>

{{-- Carousel Promo Terlaris --}}
<x-promo-slider.carousel>
   @forelse ($PromoTerlarisSlider as $Item)
    <swiper-slide class="border transition-all duration-300 w-40 h-60 rounded-xl overflow-hidden flex flex-col shadow-md mb-2 md:hidden">

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
                <h1>{{$Item['Ratings']}}</h1>
                </div>
            </div>
        </div>
    </swiper-slide>
   @empty
       
   @endforelse
</x-promo-slider.carousel>

{{-- Carousel Promo Terlaris --}}
<x-promo-slider.semua-promo-carousel>
    @forelse ($PromoTerlarisSlider as $Item)
     <swiper-slide class="border transition-all hidden duration-300 w-40 h-60 rounded-xl overflow-hidden shadow-md mb-2 md:flex md:flex-col">
 
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
                 <h1>{{$Item['Ratings']}}</h1>
                 </div>
             </div>
         </div>
     </swiper-slide>
    @empty
        
    @endforelse
 </x-promo-slider.semua-promo-carousel>

{{-- Promotion Banner --}}
<div class="w-full h-60 px-4 mx-auto my-10 rounded-xl overflow-hidden md:h-96 md:my-10">
<img src="promote.jpg" alt="" class="w-full h-full object-cover rounded-xl">
</div>



{{-- Title Promo Mingguan Desktop --}}
<div id="" class="hidden flex-row justify-between items-center px-5 mb-5 mt-7 md:flex">
    <h1 class="font-semibold text-2xl">Ada Promo Mingguan loh!</h1>
    <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
</div>
<x-promo-slider.semua-promo-carousel>
    @forelse ($PromoTerlarisSlider as $Item)
     <swiper-slide class="border transition-all hidden duration-300 w-40 h-60 rounded-xl overflow-hidden shadow-md mb-2 md:flex md:flex-col">
 
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
                 <h1>{{$Item['Ratings']}}</h1>
                 </div>
             </div>
         </div>
     </swiper-slide>
    @empty
        
    @endforelse
 </x-promo-slider.semua-promo-carousel>
@endsection
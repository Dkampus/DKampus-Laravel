@extends('layouts.PromoLayout')
@section('contentPromo')

{{-- Title Promo Terlaris Mobile --}}
<div class="flex flex-row justify-between items-center px-5 mb-5 mt-7 md:hidden">
    <h1 class="font-semibold text-2xl">Promo Terlaris</h1>
    <a href="/promo/semua" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
</div>

{{-- Title Promo Terlaris Desktop --}}
<div id="" class="hidden flex-row justify-between items-center px-5 mb-5 mt-7 md:flex">
    <h1 class="font-semibold text-2xl">Semua Promo yang paling Inginkan</h1>
    <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
</div>

{{-- Carousel Promo Terlaris --}}
<x-promo-slider.carousel>
   @forelse ($PromoTerlarisSlider as $Item)
    <swiper-slide class="w-full h-full bg-white rounded-xl shadow-md mb-2 md:hidden overflow-hidden border transition-all duration-300 flex flex-col">
        <img src="{{Storage::url($Item['Img'])}}" alt="" class="w-full h-40 object-cover">
        <img src="{{$Item['Discount']}}" alt="" class="absolute">
        <a href="/detail-makanan/{{$Item['nama_makanan']}}" class="p-4">
            <div class="tracking-wide text-l text-black font-semibold truncate">{{$Item['nama_makanan']}}</div>
            <div class="flex items-center mt-1">
                <img src="{{asset('shop.svg')}}" alt="" class="w-5 h-5">
                <p class="text-[#5E5E5E] ml-2 truncate">{{$Item['nama_umkm']}}</p>
            </div>
            <div class="flex justify-between items-center mt-1">
                <p class="block text lg leading-tight font-medium text-black">Rp {{number_format($Item['PriceDiscount'], 0, ',', '.')}}</p>
                <p class="line-through text-[#BCBCBC] text-xs sm:text-base font-semibold">{{number_format($Item['PriceOri'], 0, ',', '.')}}</p>
                <div class="flex items center">
                    <img src="Iconly/Bold/Star.svg" alt="" class="w-5 h-5">
                    <p class="text-[#5E5E5E] text-m ml-2">{{$Item['Ratings']}}</p>
                </div>
            </div>
        </a>
    </swiper-slide>
   @empty
         <p class="lg:hidden text-center px-5 py-5">Data is not Found</p>
   @endforelse
</x-promo-slider.carousel>

{{-- Carousel Promo Terlaris --}}
<x-promo-slider.semua-promo-carousel>
    @forelse ($PromoTerlarisSlider as $Item)
     <swiper-slide class="border transition-all hidden duration-300 w-40 h-60 rounded-xl overflow-hidden shadow-md mb-2 md:flex md:flex-col">

         {{-- Header Card --}}
         <div id="headerCard" class="w-full">
             <img src="{{$Item['Discount']}}" alt="" class="absolute">
             <img src="{{Storage::url($Item['Img'])}}" alt="" class="w-full h-[8rem] object-cover">
         </div>

         {{-- Content card --}}
         <div id="contentCard" class="px-2 py-2 flex flex-col gap-1 justify-center h-[45%]">

             {{-- Prices --}}
             <div id="prices" class="flex flex-row items-center gap-2.5 mt-1 h-max overflow-x-auto">
                 <h1 class="text-[#F9832A] font-bold text-xl">Rp. {{number_format($Item['PriceDiscount'], 0, ',', '.')}}</h1>
                 <h1 class="line-through text-[#BCBCBC] text-sm sm:text-base font-semibold">{{number_format($Item['PriceOri'], 0, ',', '.')}}</h1>
             </div>

             {{-- Desc --}}
             <div id="desc" class="flex flex-col gap-0.5">
                 <h1 class="font-semibold text-lg text-wrapper-promo-terlaris">{{$Item['nama_makanan']}}</h1>
                 <div id="ratings" class="w-max overflow-x-scroll flex flex-row items-center gap-1.5">
                 <img src="Iconly/Bold/Star.svg" alt="">
                 <h1>{{$Item['Ratings']}}</h1>
                 </div>
             </div>
         </div>
     </swiper-slide>
    @empty
        <p class="text-center px-5 py-5">Data is not Found</p>
    @endforelse
 </x-promo-slider.semua-promo-carousel>

{{-- Promotion UMKM Header Mobile --}}
<div class="flex flex-row justify-between items-center px-5 mb-5 mt-7 md:hidden">
    <h1 class="font-semibold text-2xl">Lagi Promo Juga!</h1>
        {{--<a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>--}}
</div>

{{-- Promotion UMKM Card --}}
@foreach($UmkmHavePromo->take(5) as $Item)
    <div class="w-full h-60 px-4 mx-auto my-5 rounded-xl md:h-96 md:my-5 md:hidden">
        <div class="w-full h-full bg-white rounded-xl shadow-xl border transition-all duration-300 overflow-hidden">
            <a href="/detail-warung/{{$Item['nama_umkm']}}">
                <img src="{{Storage::url($Item['image_umkm'])}}" alt="" class="w-full h-32 object-cover">
            </a>
            <div class="p-4">
                <a href="/detail-warung/{{$Item['nama_umkm']}}" class="tracking-wide text-l text-black font-semibold truncate">
                    {{$Item['nama_umkm'] ?? 'null'}}
                </a>
                <div class="flex items center mt-1">
                    <a href="/detail-warung/{{$Item['nama_umkm']}}" class="text-[#5E5E5E] truncate">{{ucfirst($Item['Category']) ?? 'null'}}</a>
                </div>
            </div>
            {{-- rounded bottom --}}
            <div class="w-full h-12 bg-[#F9832A]">
                <a class="text-white font-semibold text-sm ml-2">Warung ini lagi ada promo {{$Item['Discount'] ?? 'null'}}% loh!</a>
            </div>
        </div>
    </div>
@endforeach
{{-- If empty --}}
@if($UmkmHavePromo->isEmpty())
    <p class="md:hidden lg:hidden text-center px-5 py-5">Data is not Found</p>
@endif


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
             <img src="{{Storage::url($Item['Img'])}}" alt="" class="w-full h-[8rem] object-cover">
         </div>

         {{-- Content card --}}
         <div id="contentCard" class="px-2 py-2 flex flex-col gap-1 justify-center h-[45%]">

             {{-- Prices --}}
             <div id="prices" class="flex flex-row items-center gap-2.5 mt-1 h-max overflow-x-auto">
                 <h1 class="text-[#F9832A] font-bold text-xl">Rp. {{number_format($Item['PriceDiscount'], 0, ',', '.')}}</h1>
                 <h1 class="line-through text-[#BCBCBC] text-sm sm:text-base font-semibold">{{number_format($Item['PriceOri'], 0, ',', '.')}}</h1>
             </div>

             {{-- Desc --}}
             <div id="desc" class="flex flex-col gap-0.5">
                 <h1 class="font-semibold text-lg text-wrapper-promo-terlaris">{{$Item['nama_makanan']}}</h1>
                 <div id="ratings" class="w-max overflow-x-scroll flex flex-row items-center gap-1.5">
                 <img src="Iconly/Bold/Star.svg" alt="">
                 <h1>{{$Item['Ratings']}}</h1>
                 </div>
             </div>
         </div>
     </swiper-slide>
    @empty
        <p class="md:block text-center px-5 py-5">Data is not Found</p>
    @endforelse
 </x-promo-slider.semua-promo-carousel>
@endsection

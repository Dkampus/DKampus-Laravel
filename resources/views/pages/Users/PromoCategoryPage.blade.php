@extends('layouts.PromoLayout')
@section('contentPromo')

    {{-- Title Promo Terlaris --}}
    <div class="flex flex-row justify-between items-center px-5 mb-5 mt-7">
        <h1 class="font-semibold text-2xl">Promo {{ucfirst($NavPromo)}} Terlaris</h1>
        <a href="/promo/semua" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
    </div>

    {{-- Carousel Promo Terlaris --}}
    <x-promo-slider.carousel>
        @forelse ($PromoTerlarisSlider as $Item)
            <swiper-slide class="w-full h-full bg-white rounded-xl shadow-md mb-2 md:hidden overflow-hidden border transition-all duration-300 flex flex-col">
                <img src="{{Storage::url($Item['Img'])}}" alt="" class="w-full h-40 object-cover">
                <img src="{{$Item['Discount']}}" alt="" class="absolute">
                <div class="p-4">
                    <div class="tracking-wide text-l text-black font-semibold truncate">{{$Item['nama_makanan']}}</div>
                    <div class="flex items-center mt-1">
                        <img src="{{asset('shop.svg')}}" alt="" class="w-5 h-5">
                        <p class="text-[#5E5E5E] ml-2 truncate">{{$Item['nama_umkm']}}</p>
                    </div>
                    <div class="flex justify-between items-center mt-1">
                        <p class="block text lg leading-tight font-medium text-black">Rp {{number_format($Item['PriceDiscount'], 0, ',', '.')}}</p>
                        <p class="line-through text-[#BCBCBC] text-xs sm:text-base font-semibold">{{number_format($Item['PriceOri'], 0, ',', '.')}}</p>
                        <div class="flex items center">
                            <img src="/Iconly/Bold/Star.svg" alt="" class="w-5 h-5">
                            <p class="text-[#5E5E5E] text-m ml-2">{{$Item['Ratings']}}</p>
                        </div>
                    </div>
                </div>
            </swiper-slide>
        @empty
        @endforelse
    </x-promo-slider.carousel>

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
@endsection
@include('components.navbar.navbar')

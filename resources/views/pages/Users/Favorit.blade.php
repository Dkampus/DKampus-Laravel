@extends('layouts.FavoritLayout')
@section('content')
<header class="bg-[#F9832A] w-full h-32 flex flex-col pb-8 mb-12 justify-end px-5">
    <div class="flex flex-row items-center gap-3">
        <svg class="w-[1.7rem] transition-all duration-300" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.08993 0.292134C6.66743 0.309697 7.2266 0.41053 7.76835 0.59478H7.82243C7.8591 0.612197 7.8866 0.631447 7.90493 0.648864C8.10752 0.713947 8.2991 0.78728 8.48243 0.888114L8.83077 1.04395C8.96827 1.11728 9.13327 1.25386 9.22493 1.30978C9.3166 1.36386 9.41743 1.41978 9.49993 1.48303C10.5183 0.70478 11.7549 0.283114 13.0291 0.292134C13.6075 0.292134 14.185 0.373864 14.7341 0.558114C18.1175 1.65811 19.3367 5.37061 18.3183 8.61561C17.7408 10.2739 16.7966 11.7873 15.56 13.0239C13.7899 14.738 11.8475 16.2597 9.7566 17.5705L9.52743 17.7089L9.2891 17.5614C7.19085 16.2597 5.23743 14.738 3.45085 13.0147C2.22252 11.7781 1.27743 10.2739 0.690767 8.61561C-0.345066 5.37061 0.874101 1.65811 4.29418 0.538864C4.56002 0.447197 4.8341 0.38303 5.1091 0.34728H5.2191C5.47668 0.309697 5.73243 0.292134 5.9891 0.292134H6.08993ZM14.2574 3.18895C13.8816 3.0597 13.4691 3.26228 13.3316 3.64728C13.2033 4.03228 13.4049 4.45395 13.7899 4.59053C14.3775 4.81053 14.7708 5.38895 14.7708 6.0297V6.05811C14.7533 6.26803 14.8166 6.47061 14.9449 6.62645C15.0733 6.78228 15.2658 6.87303 15.4674 6.89228C15.8433 6.8822 16.1641 6.58061 16.1916 6.1947V6.08561C16.2191 4.80136 15.4408 3.63811 14.2574 3.18895Z" fill="{{'#FFF'}}"/>
        </svg>
        <h1 class="text-[1.350rem] text-white font-semibold">Warung dan Makanan Favorite</h1>
    </div>
</header>
<main class="px-5">
    <div class="flex flex-row justify-between items-center my-5 md:mt-10 md:mb-5">
        <h1 class="font-semibold w-max text-[4.5vw] sm:text-2xl">List Favorit Warung</h1>
        <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
    </div>

    {{-- Slider Rekomendasi Warung --}}
{{--    <x-list.slider>--}}
{{--        @forelse ($RekomendasiWarung as $item)--}}
{{--            <swiper-slide class="w-96 h-[17rem] relative border-2 rounded-xl transition-all duration-300 hover:shadow-md">--}}
{{--                <img src="/discount50%.svg" alt="" class="fixed z-[60] top-5 w-16 -left-2.5 md:w-[4vw]">--}}
{{--                <a href="/detail-warung/{{$item->id}}" class="w-full h-full bg-white overflow-hidden">--}}
{{--                    <img src="{{Storage::url($item->logo_umkm)}}" alt="" class="w-[45rem] h-40 object-cover rounded-xl">--}}
{{--                    <div class="flex flex-col px-3 h-24 justify-center">--}}
{{--                    <div class="flex w-max flex-row gap-1">--}}
{{--                    <img src=clock.svg alt="" class="w-5">--}}
{{--                    <h1 class="text-[#F9832A] text-sm sm:text-base">09:00 - 21:00</h1>--}}
{{--                    </div>--}}
{{--                    <h1 class="font-semibold text-[3vw] text-base sm:text-xl">{{$item->nama_umkm}}</h1>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </swiper-slide>--}}
{{--        @empty--}}
{{--        <p>Data is not Found</p>--}}
{{--        @endforelse--}}
{{--    </x-list.slider>--}}

    {{-- Title Promo Terlaris --}}
    <div class="flex flex-row justify-between items-center mb-5 mt-7">
        <h1 class="font-semibold text-2xl">List Makanan Favorit</h1>
        <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
    </div>

    {{-- Carousel Promo Terlaris --}}
{{--    <x-promo-slider.carousel>--}}
{{--    @forelse ($PromoTerlarisSlider as $Item)--}}
{{--        <swiper-slide class="border transition-all duration-300 w-40 h-60 rounded-xl overflow-hidden shadow-md mb-2">--}}

{{--            --}}{{-- Header Card --}}
{{--            <div id="headerCard" class="w-full">--}}
{{--                <img src="{{$Item['Discount']}}" alt="" class="absolute">--}}
{{--                <img src="{{$Item['Img']}}" alt="" class="w-full h-32">--}}
{{--            </div>--}}

{{--            --}}{{-- Content card --}}
{{--            <div id="contentCard" class="px-2 py-2 flex flex-col gap-1 justify-center h-[45%]">--}}

{{--                --}}{{-- Prices --}}
{{--                <div id="prices" class="flex flex-row items-center gap-2.5 mt-1 h-max overflow-x-auto">--}}
{{--                    <h1 class="text-[#F9832A] font-bold text-xl">{{$Item['PriceDiscount']}}</h1>--}}
{{--                    <h1 class="line-through text-[#BCBCBC] text-sm sm:text-base font-semibold">{{$Item['PriceOri']}}</h1>--}}
{{--                </div>--}}

{{--                --}}{{-- Desc --}}
{{--                <div id="desc" class="flex flex-col gap-0.5">--}}
{{--                    <h1 class="font-semibold text-lg text-wrapper-promo-terlaris">{{$Item['Title']}}</h1>--}}
{{--                    <div id="ratings" class="w-max overflow-x-scroll flex flex-row items-center gap-1.5">--}}
{{--                    <img src="Iconly/Bold/Star.svg" alt="">--}}
{{--                    <h1>{{$Item['Ratings']}}</h1>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </swiper-slide>--}}
{{--    @empty--}}

{{--    @endforelse--}}
{{--    </x-promo-slider.carousel>--}}

    <div class="flex flex-row justify-between items-center mt-7 md:mt-10  md:mb-5">
            <h1 class="font-semibold w-max text-[4.5vw] sm:text-2xl">Rekomendasi Makanan</h1>
            <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>
    </div>
 {{-- Card list Rekomendasi Makanan --}}
{{-- <x-list-food.slider>--}}
{{--    @foreach ($RekomendasiMakanan as $menu)--}}
{{--    @php $harga = number_format($menu->harga, 0, ',', '.'); @endphp--}}
{{--        <div class="food-list-scrollTrigger w-full h-max flex flex-col relative justify-evenly bg-white border-2 rounded-xl overflow-hidden transition-all duration-300 my-2 hover:shadow-md">--}}
{{--            <img src="{{Storage::url($menu->image)}}" alt="" class="w-[40rem] h-60 object-cover relative top-0">--}}
{{--            --}}{{-- Description Card --}}
{{--            <div class="w-full flex flex-row items-center justify-between px-3 py-4">--}}
{{--            --}}{{-- Title & Warung --}}
{{--            <div class="flex flex-col justify-between items-start h-full">--}}
{{--                <h1 class="text-wrapper font-semibold text-[4vw] sm:text-2xl">{{$menu->nama_makanan}}</h1>--}}
{{--                <div class="flex flex-row items-center gap-1">--}}
{{--                    <img src='Iconly/Bold/Star.svg' alt="" class="w-5">--}}
{{--                    <h1 class="text-black font-light">{{$menu->rating}}</h1>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            --}}{{-- Ratings & Price --}}
{{--            <div class="flex flex-col justify-between items-end h-full">--}}
{{--                <div class="flex flex-row gap-2 items-center">--}}
{{--                    <img src="shop.svg" alt="" class="w-4">--}}
{{--                    <h1 class="text-[#787878] text-wrapper">{{$menu->data_umkm->nama_umkm}}</h1>--}}
{{--                </div>--}}
{{--                <h1 class="text-[#F9832A] font-semibold text-[4vw] sm:text-2xl">Rp. {{$harga}}</h1>--}}
{{--            </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
{{--</x-list-food.slider>--}}


</main>
@endsection

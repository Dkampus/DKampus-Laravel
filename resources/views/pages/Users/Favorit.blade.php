@extends('layouts.FavoritLayout')
@section('content')
{{--<header class="bg-[#F9832A] w-full h-32 flex flex-col pb-8 mb-12 justify-end px-5">--}}
{{--    <div class="flex flex-row items-center gap-3">--}}
{{--        <svg class="w-[1.7rem] transition-all duration-300" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--        <path d="M6.08993 0.292134C6.66743 0.309697 7.2266 0.41053 7.76835 0.59478H7.82243C7.8591 0.612197 7.8866 0.631447 7.90493 0.648864C8.10752 0.713947 8.2991 0.78728 8.48243 0.888114L8.83077 1.04395C8.96827 1.11728 9.13327 1.25386 9.22493 1.30978C9.3166 1.36386 9.41743 1.41978 9.49993 1.48303C10.5183 0.70478 11.7549 0.283114 13.0291 0.292134C13.6075 0.292134 14.185 0.373864 14.7341 0.558114C18.1175 1.65811 19.3367 5.37061 18.3183 8.61561C17.7408 10.2739 16.7966 11.7873 15.56 13.0239C13.7899 14.738 11.8475 16.2597 9.7566 17.5705L9.52743 17.7089L9.2891 17.5614C7.19085 16.2597 5.23743 14.738 3.45085 13.0147C2.22252 11.7781 1.27743 10.2739 0.690767 8.61561C-0.345066 5.37061 0.874101 1.65811 4.29418 0.538864C4.56002 0.447197 4.8341 0.38303 5.1091 0.34728H5.2191C5.47668 0.309697 5.73243 0.292134 5.9891 0.292134H6.08993ZM14.2574 3.18895C13.8816 3.0597 13.4691 3.26228 13.3316 3.64728C13.2033 4.03228 13.4049 4.45395 13.7899 4.59053C14.3775 4.81053 14.7708 5.38895 14.7708 6.0297V6.05811C14.7533 6.26803 14.8166 6.47061 14.9449 6.62645C15.0733 6.78228 15.2658 6.87303 15.4674 6.89228C15.8433 6.8822 16.1641 6.58061 16.1916 6.1947V6.08561C16.2191 4.80136 15.4408 3.63811 14.2574 3.18895Z" fill="{{'#FFF'}}"/>--}}
{{--        </svg>--}}
{{--        <h1 class="text-[1.350rem] text-white font-semibold">Warung dan Makanan Favorite</h1>--}}
{{--    </div>--}}
{{--</header>--}}
<main class="px-5">
    <div class="flex flex-row justify-between items-center my-5 md:mt-10 md:mb-5">
        <h1 class="font-semibold w-max text-[4.5vw] sm:text-2xl">List Favorit Warung</h1>
{{--        <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>--}}
    </div>

    {{-- Slider Rekomendasi Warung --}}

    <x-list.slider>
        @forelse ($RekomendasiWarung as $index => $item)
            <swiper-slide class="w-96 h-[17rem] relative border-2 rounded-xl transition-all duration-300 hover:shadow-md">
                <img src="/discount50%.svg" alt="" class="fixed z-[60] top-5 w-16 -left-2.5 md:w-[4vw]">
                <a href="/detail-warung/{{$item->nama_umkm}}" class="w-full h-full bg-white overflow-hidden">
                    <img src="{{Storage::url($item->logo_umkm)}}" alt="" class="w-[45rem] h-40 object-cover rounded-xl">
                    <div class="flex flex-col px-3 h-24 justify-center">
                        <div class="flex w-max flex-row gap-1">
                            <img src=clock.svg alt="" class="w-5">
                            <h1 class="text-[#F9832A] text-sm sm:text-base">{{date('H:i', strtotime($item->open_time ?? '00:00'))}} - {{date('H:i', strtotime($item->close_time ?? '00:00'))}}</h1>
                        </div>
                        <h1 class="font-semibold text-[3vw] text-base sm:text-xl truncate">{{$item->nama_umkm}}</h1>
                        <div class="flex flex-row items-center gap-1">
                            <img src="Iconly/Bold/Star.svg" alt="" class="w-5">
                            <h1 class="text-[#787878] text-sm sm:text-base">{{$item->rating}}</h1>
                            @if ($listJarak != null && Auth::id() != null)
                                @php $distanceInMeters = $listJarak[$index] @endphp
                                @if ($distanceInMeters < 1000) @php $formattedDistance=number_format($distanceInMeters, 0) . ' m' @endphp <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.5 6.125C6.98223 6.125 6.5625 5.73325 6.5625 5.25C6.5625 4.76675 6.98223 4.375 7.5 4.375C8.01777 4.375 8.4375 4.76675 8.4375 5.25C8.4375 5.73325 8.01777 6.125 7.5 6.125Z" fill="#F8832B" />
                                    <path d="M7.5 0.875C10.0846 0.875 12.1875 2.75215 12.1875 5.05859C12.1875 6.15699 11.6511 7.6177 10.5932 9.40024C9.74355 10.8314 8.76064 12.1256 8.24941 12.7695C8.16303 12.8796 8.05008 12.969 7.91972 13.0307C7.78937 13.0924 7.64527 13.1245 7.49912 13.1245C7.35297 13.1245 7.20888 13.0924 7.07852 13.0307C6.94816 12.969 6.83521 12.8796 6.74883 12.7695C6.23848 12.1256 5.25469 10.8314 4.40508 9.40024C3.34893 7.61824 2.8125 6.15754 2.8125 5.05859C2.8125 2.75215 4.91543 0.875 7.5 0.875ZM7.5 7C7.87084 7 8.23335 6.89736 8.54169 6.70507C8.85004 6.51278 9.09036 6.23947 9.23227 5.9197C9.37419 5.59993 9.41132 5.24806 9.33897 4.90859C9.26663 4.56913 9.08805 4.25731 8.82583 4.01256C8.5636 3.76782 8.22951 3.60115 7.86579 3.53363C7.50208 3.4661 7.12508 3.50076 6.78247 3.63321C6.43986 3.76566 6.14702 3.98997 5.94099 4.27775C5.73497 4.56554 5.625 4.90388 5.625 5.25C5.62554 5.71397 5.82326 6.1588 6.17477 6.48688C6.52629 6.81496 7.00289 6.99949 7.5 7Z" fill="#F8832B" />
                                </svg>
                                <h1 id="distance_{{ $index }}" class="text-[#787878] text-sm sm:text-base">{{ $formattedDistance ?? '-' }}</h1>
                                @else
                                    @php $formattedDistance = number_format($distanceInMeters / 1000, 2) . ' km' @endphp
                                    <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.5 6.125C6.98223 6.125 6.5625 5.73325 6.5625 5.25C6.5625 4.76675 6.98223 4.375 7.5 4.375C8.01777 4.375 8.4375 4.76675 8.4375 5.25C8.4375 5.73325 8.01777 6.125 7.5 6.125Z" fill="#F8832B" />
                                        <path d="M7.5 0.875C10.0846 0.875 12.1875 2.75215 12.1875 5.05859C12.1875 6.15699 11.6511 7.6177 10.5932 9.40024C9.74355 10.8314 8.76064 12.1256 8.24941 12.7695C8.16303 12.8796 8.05008 12.969 7.91972 13.0307C7.78937 13.0924 7.64527 13.1245 7.49912 13.1245C7.35297 13.1245 7.20888 13.0924 7.07852 13.0307C6.94816 12.969 6.83521 12.8796 6.74883 12.7695C6.23848 12.1256 5.25469 10.8314 4.40508 9.40024C3.34893 7.61824 2.8125 6.15754 2.8125 5.05859C2.8125 2.75215 4.91543 0.875 7.5 0.875ZM7.5 7C7.87084 7 8.23335 6.89736 8.54169 6.70507C8.85004 6.51278 9.09036 6.23947 9.23227 5.9197C9.37419 5.59993 9.41132 5.24806 9.33897 4.90859C9.26663 4.56913 9.08805 4.25731 8.82583 4.01256C8.5636 3.76782 8.22951 3.60115 7.86579 3.53363C7.50208 3.4661 7.12508 3.50076 6.78247 3.63321C6.43986 3.76566 6.14702 3.98997 5.94099 4.27775C5.73497 4.56554 5.625 4.90388 5.625 5.25C5.62554 5.71397 5.82326 6.1588 6.17477 6.48688C6.52629 6.81496 7.00289 6.99949 7.5 7Z" fill="#F8832B" />
                                    </svg>
                                    <h1 id="distance_{{ $index }}" class="text-[#787878] text-sm sm:text-base">{{ $formattedDistance ?? '-' }}</h1>
                                    <input type="text" value="{{ $item->geo }}" id="umkmAddress" class="hidden">
                                @endif
                            @else
                                <svg class="hidden" width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.5 6.125C6.98223 6.125 6.5625 5.73325 6.5625 5.25C6.5625 4.76675 6.98223 4.375 7.5 4.375C8.01777 4.375 8.4375 4.76675 8.4375 5.25C8.4375 5.73325 8.01777 6.125 7.5 6.125Z" fill="#F8832B" />
                                    <path d="M7.5 0.875C10.0846 0.875 12.1875 2.75215 12.1875 5.05859C12.1875 6.15699 11.6511 7.6177 10.5932 9.40024C9.74355 10.8314 8.76064 12.1256 8.24941 12.7695C8.16303 12.8796 8.05008 12.969 7.91972 13.0307C7.78937 13.0924 7.64527 13.1245 7.49912 13.1245C7.35297 13.1245 7.20888 13.0924 7.07852 13.0307C6.94816 12.969 6.83521 12.8796 6.74883 12.7695C6.23848 12.1256 5.25469 10.8314 4.40508 9.40024C3.34893 7.61824 2.8125 6.15754 2.8125 5.05859C2.8125 2.75215 4.91543 0.875 7.5 0.875ZM7.5 7C7.87084 7 8.23335 6.89736 8.54169 6.70507C8.85004 6.51278 9.09036 6.23947 9.23227 5.9197C9.37419 5.59993 9.41132 5.24806 9.33897 4.90859C9.26663 4.56913 9.08805 4.25731 8.82583 4.01256C8.5636 3.76782 8.22951 3.60115 7.86579 3.53363C7.50208 3.4661 7.12508 3.50076 6.78247 3.63321C6.43986 3.76566 6.14702 3.98997 5.94099 4.27775C5.73497 4.56554 5.625 4.90388 5.625 5.25C5.62554 5.71397 5.82326 6.1588 6.17477 6.48688C6.52629 6.81496 7.00289 6.99949 7.5 7Z" fill="#F8832B" />
                                </svg>
                                <h1 id="distance_{{ $index }}" class="text-[#787878] text-sm sm:text-base hidden">Data is not Found</h1>
                            @endif
                        </div>
                    </div>
                </a>
            </swiper-slide>
        @empty
        <p>Data is not Found</p>
        @endforelse
    </x-list.slider>

    {{-- Title Promo Terlaris --}}
    <div class="flex flex-row justify-between items-center mb-5 mt-7">
        <h1 class="font-semibold text-2xl">List Makanan Favorit</h1>
        {{--<a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>--}}
    </div>

    <x-list.slider>
        @forelse ($RekomendasiMakanan as $index => $item)
            <swiper-slide class="w-96 h-[17rem] relative border-2 rounded-xl transition-all duration-300 hover:shadow-md">
                <img src="/discount50%.svg" alt="" class="fixed z-[60] top-5 w-16 -left-2.5 md:w-[4vw]">
                <a href="/detail-makanan/{{$item->nama_makanan}}" class="w-full h-full bg-white overflow-hidden">
                    <img src="{{Storage::url($item->image)}}" alt="" class="w-[45rem] h-40 object-cover rounded-xl">
                    <div class="flex flex-col px-3 h-24 justify-center">
                        <h1 class="font-semibold text-[3vw] text-base sm:text-xl truncate">{{$item->nama_makanan}}</h1>
                        <div class="flex flex-row items-center gap-1">
                            <img src="Iconly/Bold/Star.svg" alt="" class="w-5">
                            <h1 class="text-[#787878] text-sm sm:text-base">{{$item->rating}}</h1>
                            <h1 class="text-[#787878] text-sm sm:text-base">•</h1>
                            <h1 class="text-[#787878] text-sm sm:text-base">{{$item->data_umkm->nama_umkm}}</h1>
                        </div>
                        <h1 class="text-[#F9832A] font-semibold text-[3vw] sm:text-xl">Rp. {{number_format($item->harga, 0, ',', '.')}}</h1>
                    </div>
                </a>
            </swiper-slide>
        @empty
        <p>Data is not Found</p>
        @endforelse
    </x-list.slider>

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
        @endforelse
    </x-promo-slider.carousel>

{{--    <div class="flex flex-row justify-between items-center mt-7 md:mt-10  md:mb-5">--}}
{{--            <h1 class="font-semibold w-max text-[4.5vw] sm:text-2xl">Rekomendasi Makanan</h1>--}}
{{--            <a href="" class="text-[#F9832A] text-lg font-semibold">Lihat Semua</a>--}}
{{--    </div>--}}
{{--  Card list Rekomendasi Makanan--}}
{{-- <x-list-food.slider>--}}
{{--    @foreach ($RekomendasiMakanan as $menu)--}}
{{--    @php $harga = number_format($menu->harga, 0, ',', '.'); @endphp--}}
{{--        <div class="food-list-scrollTrigger w-full h-max flex flex-col relative justify-evenly bg-white border-2 rounded-xl overflow-hidden transition-all duration-300 my-2 hover:shadow-md">--}}
{{--            <img src="{{Storage::url($menu->image)}}" alt="" class="w-[40rem] h-60 object-cover relative top-0">--}}
{{--            Description Card--}}
{{--            <div class="w-full flex flex-row items-center justify-between px-3 py-4">--}}
{{--            Title & Warung--}}
{{--            <div class="flex flex-col justify-between items-start h-full">--}}
{{--                <h1 class="text-wrapper font-semibold text-[4vw] sm:text-2xl">{{$menu->nama_makanan}}</h1>--}}
{{--                <div class="flex flex-row items-center gap-1">--}}
{{--                    <img src='Iconly/Bold/Star.svg' alt="" class="w-5">--}}
{{--                    <h1 class="text-black font-light">{{$menu->rating}}</h1>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            Ratings & Price--}}
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

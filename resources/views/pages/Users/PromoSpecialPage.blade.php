@extends('layouts.Root')
@section('content')
    @include('components.navbar.navbar')
    <header class="sticky top-0 left-0 flex justify-center w-full bg-white z-10 shadow-md py-8">
        <a href="{{'/'}}" class="absolute top-5 left-5 flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
            </svg>
            <h1 class="font-bold text-black text-xl mb-1">Semua Promo Special</h1>
        </a>
    </header>
    <main class="flex flex-col">
        <div class="space-y-4">
            @foreach($umkm->sortBy('nama_umkm') as $umkmItem => $warung)
                @php
                    $discountedMenusFromUmkm = $promoSpecial->where('data_umkm_id', $warung->id)->where('diskon', '>', 0);
                @endphp
                @if($discountedMenusFromUmkm->count() > 0)
                    <div class="px-4 pt-4 rounded-lg">
                        {{--Umkm--}}
                        <div class="flex justify-between items-center mb-2">
                            <a href="#" class="flex items-center gap-2 font-bold">{{$warung->nama_umkm}}</a>
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('/Iconly/Bold/Star.svg') }}" alt="" class="w-5 h-5">
                                <p class="text-[#5E5E5E] text-sm">{{$promoSpecial->where('data_umkm_id', $warung->id)->first()->rating ?? '0.0'}}</p>
                                <a class="text-[#5E5E5E] text-sm font-semibold">{{$umkmItem->jarak ?? '0.0'}} KM</a>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <a class="">{{ucfirst($promoSpecial->where('data_umkm_id', $warung->id)->first()->category) ?? 'n/a'}}</a>
                            <a class="">{{$umkmItem->jam_buka ?? 'n/a'}} - {{$umkmItem->jam_tutup ?? 'n/a'}}</a>
                        </div>
                    </div>
                    <div class="border-b border-[#E5E5E5] mb-2"></div>
                    @foreach($discountedMenusFromUmkm as $menu)
                        <div class="flex justify-between px-4">
                            <div class="flex flex-col">
                                <a href="#" class="font-bold text-l">{{$menu->nama_makanan}}</a>
                                <a class="text-base">{{$menu->deskripsi}}</a>
                                <a class="text-sm">Rp {{number_format($menu->harga - ($menu->harga * $menu->diskon / 100), 0, ',', '.')}} <span class="line-through text-[#BCBCBC] text-xs sm:text-base font-semibold mx-2">{{number_format($menu->harga, 0, ',', '.')}}</span></a>
                            </div>
                            <div>
                                <img src="{{ Storage::url($menu->image) }}" alt="" class="w-28 h-28 object-cover rounded-lg">
                            </div>
                        </div>
                        {{--button pesan--}}
                        <div class="flex justify-center items-center px-4 py-2 mx-2 bg-[#F9832A] rounded-lg">
                            <a href="#" class="text-white font-bold">Pesan</a>
                        </div>
                        <div class="border-b border-[#E5E5E5]"></div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </main>
@endsection

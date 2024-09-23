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
            @endforeach
        </x-carousel.slider-category>

        <x-carousel.slider-category-desktop>
            @foreach ($CarouselDesktop as $item)
            @endforeach
        </x-carousel.slider-category-desktop>
        {{-- <div class="bg-gradient-to-l from-white from-[30%] to-transparent w-14 z-50 h-28 fixed right-0"></div> --}}
    </div>

    {{-- Slider Rekomendasi Warung --}}
    <x-list.slider>
        @forelse ($RekomendasiWarung as $index => $item)
        @empty
        <p>Data is not Found</p>
        @endforelse
    </x-list.slider>

    {{-- Slider Rekomendasi Makanan --}}
    <x-list.slider-makanan>
        @if ($RekomendasiMakanan->isEmpty())
            <p class="text-center px-5 py-5">Data is not Found</p>
        @endif
        @foreach ($RekomendasiMakanan as $menu)
        @endforeach
    </x-list.slider-makanan>

    {{-- Div anouncement jastip --}}
    <span class="font-semibold">📢 Perhatian Click button dibawah atau banner diatas untuk memesan jastip</span>
    <a href="/jastip" class="flex flex-row items-center justify-center w-full h-14 bg-[#F9832A] text-white font-semibold rounded-xl mt-5">
        <h1 class="text-xl">Jastip</h1>
    </a>
    @if (Auth::user() != null)
        <x-floatingcshelp />
    @endif
    {{-- Popup info dev --}}
    <div id="developmentModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Informasi
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Website ini masih dalam tahap pengembangan. Terima kasih atas pengertian nya ❤️.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#F9832A] text-base font-medium text-white hover:bg-[#ED6600] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F9832A] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="document.getElementById('developmentModal').classList.add('hidden')">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

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
<script>
    window.onload = function() {
        var lastShown = localStorage.getItem('lastShown');

        if (!lastShown) {
            document.getElementById('developmentModal').classList.remove('hidden');
            localStorage.setItem('lastShown', new Date().getTime());
        } else {
            if (new Date().getTime() - lastShown > 3600000) {
                // Jika sudah lebih dari 1 jam, tampilkan modal dan perbarui waktu terakhir modal ditampilkan di localStorage
                document.getElementById('developmentModal').classList.remove('hidden');
                localStorage.setItem('lastShown', new Date().getTime());
            }
        }

        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('developmentModal').classList.add('hidden');
        });
    };
</script>
{{-- Scroll Behaviour --}}
@include('components.scrollBehaviourr.scroll-behaviour')

@endsection

@push('search')

@endpush

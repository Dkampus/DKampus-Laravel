@extends('layouts.Root')
@section('content')
    <header class="sticky top-0 left-0 flex justify-start w-full bg-white z-10 shadow-md py-2">
        <div class="flex flex-row items-center gap-10 h-full">
            <a href="{{'/'}}" class="top-5 left-5 flex items-center px-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F9832A" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.354 1.646a.5.5 0 0 1 0 .708L5.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z"/>
                </svg>
            </a>
            <div onclick class="border-2 relative bg-white z-[60] w-screen/2 h-10 flex flex-row justify-between items-center border-[#F9832A]/40 gap-2 px-10 rounded-md overflow-hidden focus:border-[#F9832A] md:h-12">
                <div class="flex flex-row items-center gap-2 h-full">
                    <form action="{{ route('search.keyword', ['keyword' => request()->input('value', 'a')]) }}" method="GET" id="search-form">
                        <div class="flex flex-row items-center gap-2 h-full mt-3">
                            <button class="min-w-[1rem] max-w-[10%] h-full md:min-w-[1.5rem]">
                                <img src="{{ asset('serach.svg') }}" alt="" class="w-full h-full align-middle">
                            </button>
                            <input onfocus="showResults()" onblur="hideResults()" id="search-input" name="value" type="" class="min-w-max sm:max-w-full h-full self-start outline-none ring-0 border-none text-[#F9832A] placeholder:font-medium placeholder:text-[#F9832A] placeholder:md:text-lg align-middle" placeholder="Cari Menu">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="flex flex-col mt-2">
            {{-- Hasil pencarian, filter button --}}
            <div class="flex flex-row justify-between items-center gap-3 px-5 py-2">
                <h1 class="font-bold text-black text-xl">Hasil pencarian <span class="text-[#F9832A]">Menu </span> terkait</h1>
                <div class="relative inline-block text-left">
                    <div>
                        <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true">
                            <img src="{{ asset('filter.svg') }}" alt="" class="w-4 h-4">
                            Filter
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 8a1 1 0 011.707-.707l3.586 3.586a1 1 0 01.707 1.707l-3.586 3.586A1 1 0 015 16V8z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" id="dropdown-menu">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" onclick="setFilter('Menu')">Menu</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" onclick="setFilter('Warung')">Warung</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- hasil search --}}
            <div class="grid grid-cols-2 gap-5 p-2">
                @foreach($menus as $menu)
                    <div class="w-full h-full bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="h-48 w-full bg-gray-300 object-cover"></div>
                        <div class="p-2">
                            <div class="tracking-wide text-l text-black font-semibold">{{ $menu->nama_makanan }}</div>
                            <div class="flex items-center mt-1">
                                <img src="{{ asset('shop.svg') }}" alt="" class="w-5 h-5">
                                <p class="text-[#5E5E5E] ml-2 truncate">{{ $menu->nama_umkm }}</p>
                            </div>
                            <div class="flex justify-between items-center mt-1">
                                <p class="block text-lg leading-tight font-medium text-black">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F9832A" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                    <p class="text-[#5E5E5E] text-m ml-2">{{ $menu->rating }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
<script>
    var activeFilter = 'Menu';

    function setFilter(filter) {
        activeFilter = filter;
        document.getElementById('filter-status').textContent = filter;
    }

    window.onload = function() {
        document.getElementById('options-menu').addEventListener('click', function() {
            var dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        });
        setFilter(activeFilter);

        // Menambahkan event listener ke input search box
        document.getElementById('search-input').addEventListener('keyup', function(event) {
            if (event.keyCode === 13) { // Jika tombol yang ditekan adalah enter
                document.getElementById('search-form').submit(); // Submit form pencarian
            }
        });
    };
</script>

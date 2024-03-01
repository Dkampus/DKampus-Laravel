 {{-- TopBar Desktop --}}
 <div id="topBarDekstop" class="hidden sticky top-0 z-10 bg-white md:flex md:flex-col md:justify-center md:border-b-2 md:border-[#F9832A]">
    <div class="hidden w-[100%] gap-0.5 pt-7 pb-8 mx-auto md:flex md:h-full md:flex-row md:items-center md:px-5">
        {{-- Logo --}}
        <div class="flex flex-row my-auto h-max items-center md:gap-2">
            <a href="/">
                <img src="logoDkampus.svg" alt="" class="min-w-[100%] max-w-[120%] md:min-w-[2vw]">
            </a>
            <h1 class="font-bold text-[#F9832A] text-2xl hidden md:flex">Dkampus</h1>
        </div>

        <a href="#" class="hidden font-normal text-xl w-max mx-auto text-[#F9832A] md:flex">
            Daftar Warung
        </a>

        {{-- Search --}}
        @include('components.header.searchDesktop')

        <button class="hidden mx-auto md:flex">
            <img src="./cart.svg" alt="">
        </button>

        {{-- Sidebar --}}
        <div class="flex flex-row items-center gap-3">
            {{-- <button>
            <img src="chat.svg" alt="" class="w-8 mr-5">
            </button> --}}
            @auth
            <button>
            <img src="chat.svg" alt="" class="w-8 mr-5">
            </button>
            @endauth
            @include('components.header.menuDesktop')
        </div>

    </div>
    @if ($Title === 'Home' || $Title === 'Promo' || $Title === 'Pesanan' || $Title === 'Favorit' || $Title === 'Status')
    {{-- <div class="w-full relative flex justify-center"> --}}
        @include('components.navbar.navbarDesktop')
    {{-- </div> --}}
    @else
    {{-- @include('components.navbar.navbar') --}}
    @endif
</div>

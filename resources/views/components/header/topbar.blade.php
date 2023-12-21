{{-- TopBar Mobile --}}
<div id="topBarMobile" class="flex flex-row w-full px-5 sticky items-center gap-0.5 pt-7 pb-5 mx-auto md:top-0 md:px-5 md:hidden">
    {{-- Logo --}}
    <div class="flex flex-row items-center md:gap-2">
        <a href="/">
            <img src="logoDkampus.svg" alt="" class="min-w-[120%] max-w-[120%] md:min-w-[2vw]">
        </a>
        <h1 class="font-bold text-[#F9832A] text-2xl hidden md:flex">Dkampus</h1>    
    </div>

    {{-- Search --}}
    @include('components.header.search')

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
        @include('components.header.menu')
    </div>
</div>
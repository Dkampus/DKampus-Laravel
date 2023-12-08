{{-- TopBar Desktop --}}
<div class="md:px-8 md:flex md:flex-col">

{{-- TopBar Mobile --}}
<div class="flex flex-row w-[100%] items-center gap-0.5 pt-7 pb-3 mx-auto">
    {{-- Logo --}}
    <div class="flex flex-row items-center md:gap-2">
        <a href="/">
            <img src="logoDkampus.svg" alt="" class="min-w-[100%] max-w-[120%] md:min-w-[2vw]">
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


</div>
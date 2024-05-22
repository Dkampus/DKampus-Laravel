{{-- TopBar Mobile --}}
<div id="topBarMobile" class="flex flex-row w-full px-5 sticky items-center gap-0.5 pt-7 pb-5 mx-auto md:top-0 md:px-5 md:hidden shadow-md bg-white z-10">
    {{-- Logo --}}
    <div class="flex flex-row items-center md:gap-2">
        <a href="/">
            <img src="{{asset('logoDkampus.svg')}}" alt="" class="min-w-[120%] max-w-[120%] md:min-w-[2vw]">
        </a>
        <h1 class="font-bold text-[#F9832A] text-2xl hidden md:flex">Dkampus</h1>
    </div>

    {{-- Search --}}
    <div class="w-[60%] relative flex flex-col items-center mx-auto md:hidden"></div>

    {{-- Sidebar --}}
    <div class="flex flex-row items-center gap-3">
        @if(Request::is('courier/dashboard'))
            @auth
                <a href = "chats" class="text-[#F9832A] text-2xl font-semibold">
                    <img src="{{asset('chat.svg')}}" alt="" class="w-8 mr-5">
                </a>
                </button>
            @endauth
        @endif
    </div>
</div>

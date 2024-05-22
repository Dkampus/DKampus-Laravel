<div class="sticky top-0 left-0 flex justify-between w-full px-5 items-center gap-0.5 pt-7 pb-5 mx-auto shadow-md bg-white z-10">

    {{-- Logo dan Judul --}}
    <div class="flex flex-row items-center gap-2">
        <a href="/">
            <img src="{{asset('logoDkampus.svg')}}" alt="" class="min-w-[5vw] max-w-[5vw] md:min-w-[2vw]">
        </a>
        <h1 class="font-bold text-[#F9832A] text-2xl md:block">Dkampus Courier</h1>
    </div>

    {{-- Sidebar Only Chatbutton --}}
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



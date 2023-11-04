{{-- TopBar --}}
<div class="flex flex-row w-[100%] items-center gap-0.5 pt-7 pb-3 mx-auto">
{{-- Logo --}}
<a href="/">
    <img src="logoDkampus.svg" alt="" class="min-w-[100%] max-w-[120%]">
</a>

{{-- Search --}}
@include('components.header.search')

{{-- Sidebar --}}
<div class="flex flex-row items-center">
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
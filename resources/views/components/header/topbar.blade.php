{{-- TopBar --}}
<div class="flex flex-row items-center pt-7 w-max gap-5 pb-3 justify-center mx-auto">
{{-- Logo --}}
<a href="/">
<img src="logoDkampus.svg" alt="" class="scale-110">
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
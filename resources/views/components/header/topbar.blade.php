{{-- TopBar --}}
<div class="flex flex-row items-center gap-1 justify-center pt-7 pb-3 px-5">
{{-- Logo --}}
<a href="/">
<img src="logoDkampus.svg" alt="" class="scale-110">
</a>

{{-- Search --}}
@include('components.header.search')

{{-- Sidebar --}}
<div class="flex flex-row items-center">
    <button>
    <img src="chat.svg" alt="" class="w-8 mr-5">
    </button>
    @include('components.header.menu')
</div>
</div>